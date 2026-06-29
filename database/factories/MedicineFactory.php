<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Paracetamol 500mg',
            'Ibuprofen 400mg',
            'Amoxicillin 250mg',
            'Cetirizine 10mg',
            'Omeprazole 20mg',
            'Metformin 500mg',
            'Azithromycin 500mg',
            'Vitamin C 1000mg',
            'Calcium + Vitamin D3',
            'Cough Syrup 100ml',
            'Antiseptic Cream 30g',
            'Eye Drops 10ml',
            'Bandage Roll',
            'ORS Sachets (Pack of 10)',
            'Multivitamin Tablets',
            'Aspirin 75mg',
            'Antacid Suspension 170ml',
            'Betadine Solution 100ml',
            'Iron + Folic Acid',
            'Loperamide 2mg',
        ]);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(2),
            'image' => null,
            'price' => fake()->randomFloat(2, 10, 500),
            'stock' => fake()->numberBetween(0, 200),
            'requires_prescription' => fake()->boolean(20), // 20% chance of requiring prescription
            'manufacturer' => fake()->randomElement([
                'Sun Pharma', 'Cipla', 'Dr. Reddy\'s', 'Lupin',
                'Mankind Pharma', 'Zydus', 'Alkem', 'Torrent Pharma',
            ]),
            'expiry_date' => fake()->dateTimeBetween('+6 months', '+3 years')->format('Y-m-d'),
            'status' => 'active',
        ];
    }
}
