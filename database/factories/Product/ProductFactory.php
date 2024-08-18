<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
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
            'store_id' => $this->faker->numberBetween(1, 100),
            'product_name' => $this->faker->sentence(6, true),
            'image' => '/images/products/' . $this->faker->numberBetween(1, 30) . '.webp',
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(50, 5000),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => $this->faker->numberBetween(1, 17),
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
