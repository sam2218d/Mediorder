<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmbedMedicines extends Command
{
    protected $signature = 'chatbot:embed';
    protected $description = 'Previously used to embed medicines into Pinecone. No longer needed — the chatbot now uses keyword search.';

    public function handle(): int
    {
        $this->info('ℹ️  This command is no longer needed.');
        $this->info('The chatbot now uses smart keyword-based search directly on your database.');
        $this->info('No embeddings or vector database required — just add medicines via the admin panel!');

        return self::SUCCESS;
    }
}
