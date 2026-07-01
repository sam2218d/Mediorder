<?php

namespace App\Console\Commands;

use App\Models\Medicine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchMedicineImages extends Command
{
    protected $signature = 'medicines:fetch-images';
    protected $description = 'Download and assign realistic medicine images to all products';

    /**
     * Curated list of high-quality, royalty-free medicine/pharmacy images from Unsplash.
     * Each is mapped to medicine name keywords for best visual match.
     */
    private array $imageMap = [
        'paracetamol' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop&q=80',
        'ibuprofen'   => 'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=400&h=400&fit=crop&q=80',
        'amoxicillin' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop&q=80',
        'cetirizine'  => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400&h=400&fit=crop&q=80',
        'omeprazole'  => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400&h=400&fit=crop&q=80',
        'metformin'   => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=400&h=400&fit=crop&q=80',
        'azithromycin' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=400&fit=crop&q=80',
        'vitamin c'   => 'https://images.unsplash.com/photo-1616671276441-2f2c277b8bf6?w=400&h=400&fit=crop&q=80',
        'calcium'     => 'https://images.unsplash.com/photo-1559757175-7cb057fba93c?w=400&h=400&fit=crop&q=80',
        'cough syrup' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400&h=400&fit=crop&q=80',
        'antiseptic'  => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400&h=400&fit=crop&q=80',
        'eye drops'   => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop&q=80',
        'bandage'     => 'https://images.unsplash.com/photo-1603398938378-e54eab446dde?w=400&h=400&fit=crop&q=80',
        'ors'         => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400&h=400&fit=crop&q=80',
        'multivitamin' => 'https://images.unsplash.com/photo-1577401239170-897c2db tried67?w=400&h=400&fit=crop&q=80',
        'aspirin'     => 'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=400&h=400&fit=crop&q=80',
        'antacid'     => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=400&h=400&fit=crop&q=80',
        'betadine'    => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400&h=400&fit=crop&q=80',
        'iron'        => 'https://images.unsplash.com/photo-1559757175-7cb057fba93c?w=400&h=400&fit=crop&q=80',
        'loperamide'  => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=400&fit=crop&q=80',
    ];

    /**
     * Fallback generic medicine images when no keyword match is found.
     */
    private array $fallbackImages = [
        'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop&q=80',
        'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop&q=80',
        'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=400&fit=crop&q=80',
        'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=400&h=400&fit=crop&q=80',
        'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=400&h=400&fit=crop&q=80',
    ];

    public function handle(): int
    {
        $medicines = Medicine::all();

        if ($medicines->isEmpty()) {
            $this->warn('No medicines found in the database.');
            return self::SUCCESS;
        }

        $this->info("Found {$medicines->count()} medicines. Downloading images...");

        // Ensure the medicines directory exists
        Storage::disk('public')->makeDirectory('medicines');

        $bar = $this->output->createProgressBar($medicines->count());
        $bar->start();

        $successCount = 0;
        $failCount = 0;

        foreach ($medicines as $medicine) {
            try {
                $imageUrl = $this->getImageUrl($medicine->name);
                $filename = 'medicines/' . $medicine->slug . '.jpg';

                $response = Http::timeout(15)->get($imageUrl);

                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());
                    $medicine->update(['image' => $filename]);
                    $successCount++;
                } else {
                    $failCount++;
                    $this->newLine();
                    $this->warn("  Failed to download image for: {$medicine->name}");
                }
            } catch (\Exception $e) {
                $failCount++;
                $this->newLine();
                $this->warn("  Error for {$medicine->name}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("✅ Downloaded {$successCount} images successfully.");

        if ($failCount > 0) {
            $this->warn("⚠️  {$failCount} images failed to download.");
        }

        return self::SUCCESS;
    }

    /**
     * Find the best matching image URL based on medicine name.
     */
    private function getImageUrl(string $name): string
    {
        $nameLower = strtolower($name);

        foreach ($this->imageMap as $keyword => $url) {
            if (str_contains($nameLower, $keyword)) {
                return $url;
            }
        }

        // Return a random fallback image
        return $this->fallbackImages[array_rand($this->fallbackImages)];
    }
}
