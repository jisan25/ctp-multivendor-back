<?php

namespace Database\Factories\Product;

use App\Models\Product\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 100),
            'customer_id' => $this->faker->numberBetween(1, 100),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph,

        ];
    }
}
