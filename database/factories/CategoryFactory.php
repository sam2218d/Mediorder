<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Pain Relief',
            'Antibiotics',
            'Vitamins & Supplements',
            'Cough & Cold',
            'Digestive Health',
            'Skin Care',
            'Eye Care',
            'Heart & BP',
            'Diabetes',
            'First Aid',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => null,
            'description' => fake()->sentence(10),
        ];
    }
}
