<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(['Minuman', 'Makanan', 'Makanan Ringan']),
            'price' => fake()->numberBetween(1000, 50000),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
