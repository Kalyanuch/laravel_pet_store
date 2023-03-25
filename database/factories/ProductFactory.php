<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'title' => $this->faker->words(3, TRUE),
            'description' => $this->faker->realText(200),
            'price' => rand(15, 9800),
            'quantity' => rand(0, 200),
            'sort_order' => rand(0, 100),
            'status' => rand(0, 1)
        ];
    }
}
