<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * The pharmacist system prompt template.
     */
    private const SYSTEM_PROMPT = <<<'PROMPT'
You are the expert, AI-powered pharmacist assistant for MediOrder. Your job is to help users find the right medicines and understand product details based strictly on our catalog.

### CONTEXT:
You will be provided with a list of relevant products retrieved from the MediOrder database.
{retrieved_context}

### YOUR DIRECTIVES:
1. STRICT GROUNDING: You must base your answer *exclusively* on the CONTEXT provided above. Do not use outside knowledge, do not mention competitors, and do not invent products, prices, or side effects that are not explicitly listed in the CONTEXT.
2. THE FALLBACK: If the user asks a question that cannot be answered using the provided CONTEXT, you must say: "I'm sorry, but I don't have information on that specific product or symptom in our current catalog. Please consult a human pharmacist." Do not attempt to guess.
3. MEDICAL DISCLAIMER: You are an AI assistant, not a doctor. If the user asks for serious medical advice or diagnosis, include this disclaimer: "⚠️ Please note: I am an AI assistant and this is not professional medical advice. Always consult with a doctor for serious conditions."
4. TONE: Be empathetic, concise, and professional.
5. FORMATTING: Use bullet points for easy reading when comparing products. Always mention the price if it is relevant. Use bold for medicine names.
6. CART SUGGESTION: When recommending a product, mention the user can add it to their cart directly from the product cards shown below your message.
PROMPT;

    /**
     * Handle a chatbot message from the user.
     */
    public function ask(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array|max:20',
            'history.*.role' => 'required_with:history|string|in:user,assistant',
            'history.*.content' => 'required_with:history|string',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        $apiKey = config('services.openrouter.api_key');

        if (! $apiKey) {
            return response()->json([
                'reply' => 'The chatbot is not configured yet. Please ask the administrator to set up the OpenRouter API key.',
                'products' => [],
            ], 500);
        }

        try {
            // Step 1: Extract keywords and search medicines in database
            $medicines = $this->searchMedicines($userMessage);

            // Step 2: Build the context string for the LLM
            $contextLines = [];
            $productCards = [];

            foreach ($medicines as $med) {
                $rx = $med->requires_prescription ? 'Yes (Prescription Required)' : 'No (Over-the-Counter)';

                $contextLines[] = implode("\n", [
                    "- **{$med->name}**",
                    "  Category: {$med->category?->name}",
                    "  Description: {$med->description}",
                    "  Manufacturer: " . ($med->manufacturer ?? 'N/A'),
                    "  Price: ₹" . number_format($med->price, 2),
                    "  Prescription Required: {$rx}",
                    "  In Stock: " . ($med->stock > 0 ? 'Yes' : 'Out of Stock'),
                ]);

                $productCards[] = [
                    'id' => $med->id,
                    'name' => $med->name,
                    'slug' => $med->slug,
                    'price' => number_format($med->price, 2),
                    'image' => $med->image ? asset('storage/' . $med->image) : null,
                    'requires_prescription' => (bool) $med->requires_prescription,
                    'category' => $med->category?->name,
                    'manufacturer' => $med->manufacturer,
                ];
            }

            $contextString = ! empty($contextLines)
                ? implode("\n\n", $contextLines)
                : 'No relevant products found in the catalog.';

            $systemPrompt = str_replace('{retrieved_context}', $contextString, self::SYSTEM_PROMPT);

            // Step 3: Call OpenRouter chat completion
            $messages = [
                ['role' => 'system', 'content' => $systemPrompt],
            ];

            // Append conversation history (keep last 10 turns for context window management)
            $recentHistory = array_slice($history, -10);
            foreach ($recentHistory as $entry) {
                $messages[] = [
                    'role' => $entry['role'],
                    'content' => $entry['content'],
                ];
            }

            $messages[] = ['role' => 'user', 'content' => $userMessage];

            $chatResponse = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url', 'http://localhost'),
                'X-Title' => 'MediOrder Chatbot',
            ])->timeout(30)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'deepseek/deepseek-chat-v3-0324',
                'messages' => $messages,
                'temperature' => 0.3,
                'max_tokens' => 800,
            ]);

            if ($chatResponse->failed()) {
                Log::error('OpenRouter Chat error', ['body' => $chatResponse->body()]);
                return $this->errorResponse('I had trouble generating a response. Please try again.');
            }

            $reply = $chatResponse->json('choices.0.message.content', 'I wasn\'t able to generate a response. Please try again.');

            return response()->json([
                'reply' => $reply,
                'products' => $productCards,
            ]);
        } catch (\Exception $e) {
            Log::error('Chatbot error', ['exception' => $e->getMessage()]);
            return $this->errorResponse('Something went wrong. Please try again later.');
        }
    }

    /**
     * Search medicines in the database using keyword matching.
     *
     * Extracts meaningful words from the user's message and searches
     * medicine names, descriptions, and category names.
     */
    private function searchMedicines(string $query): \Illuminate\Support\Collection
    {
        // Common symptom-to-medicine keyword mapping for better matching
        $symptomKeywords = [
            'fever' => ['paracetamol', 'ibuprofen', 'aspirin', 'fever'],
            'headache' => ['paracetamol', 'ibuprofen', 'aspirin', 'headache', 'pain'],
            'cold' => ['cetirizine', 'cough', 'cold', 'antihistamine'],
            'cough' => ['cough', 'syrup', 'cold'],
            'pain' => ['paracetamol', 'ibuprofen', 'aspirin', 'pain'],
            'body pain' => ['ibuprofen', 'paracetamol', 'pain'],
            'stomach' => ['omeprazole', 'antacid', 'stomach', 'ors', 'loperamide'],
            'acidity' => ['omeprazole', 'antacid', 'acidity'],
            'infection' => ['amoxicillin', 'azithromycin', 'antibiotic', 'antiseptic', 'betadine'],
            'allergy' => ['cetirizine', 'allergy', 'antihistamine'],
            'diabetes' => ['metformin', 'diabetes', 'sugar'],
            'vitamin' => ['vitamin', 'multivitamin', 'calcium', 'iron'],
            'supplement' => ['vitamin', 'multivitamin', 'calcium', 'iron', 'folic'],
            'wound' => ['antiseptic', 'betadine', 'bandage', 'wound'],
            'eye' => ['eye', 'drops'],
            'diarrhea' => ['ors', 'loperamide', 'diarrhea'],
            'diarrhoea' => ['ors', 'loperamide', 'diarrhea'],
            'nausea' => ['antacid', 'omeprazole'],
            'immunity' => ['vitamin', 'multivitamin'],
            'bone' => ['calcium', 'vitamin d'],
            'anemia' => ['iron', 'folic'],
            'anaemia' => ['iron', 'folic'],
        ];

        $queryLower = strtolower($query);

        // Collect search terms from symptom mapping
        $searchTerms = [];
        foreach ($symptomKeywords as $symptom => $keywords) {
            if (str_contains($queryLower, $symptom)) {
                $searchTerms = array_merge($searchTerms, $keywords);
            }
        }

        // Also extract individual words from the query (3+ chars, skip stopwords)
        $stopwords = ['the', 'and', 'for', 'have', 'has', 'had', 'with', 'from', 'some', 'any', 'can', 'you', 'please', 'help', 'need', 'want', 'get', 'give', 'take', 'mild', 'severe', 'chronic', 'acute'];
        $words = preg_split('/\s+/', $queryLower);
        foreach ($words as $word) {
            $word = preg_replace('/[^a-z]/', '', $word);
            if (strlen($word) >= 3 && ! in_array($word, $stopwords)) {
                $searchTerms[] = $word;
            }
        }

        $searchTerms = array_unique($searchTerms);

        if (empty($searchTerms)) {
            // If no keywords matched, return all active medicines as context
            return Medicine::with('category')
                ->where('status', 'active')
                ->limit(10)
                ->get();
        }

        // Search medicines where name, description, or category matches any keyword
        return Medicine::with('category')
            ->where('status', 'active')
            ->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orWhere('name', 'LIKE', "%{$term}%")
                      ->orWhere('description', 'LIKE', "%{$term}%")
                      ->orWhereHas('category', function ($catQuery) use ($term) {
                          $catQuery->where('name', 'LIKE', "%{$term}%");
                      });
                }
            })
            ->limit(10)
            ->get();
    }

    /**
     * Return a standardized error response.
     */
    private function errorResponse(string $message): JsonResponse
    {
        return response()->json([
            'reply' => $message,
            'products' => [],
        ], 200); // Return 200 so the frontend can still display the message gracefully
    }
}
