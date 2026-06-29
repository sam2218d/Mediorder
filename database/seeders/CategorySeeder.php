<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed 10 pharmacy categories.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();
    }
}
