<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Seed 20 medicines (assigned to random existing categories).
     */
    public function run(): void
    {
        Medicine::factory()->count(20)->create();
    }
}
