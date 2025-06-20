<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_code' => $this->faker->unique()->bothify('PRD-####-???'),
            'description' => $this->faker->sentence(3),
            'price_2023' => $this->faker->randomFloat(2, 10, 1000),
            'price_2024' => $this->faker->randomFloat(2, 10, 1000),
            'price_2025' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
