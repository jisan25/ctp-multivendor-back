<?php

namespace Database\Factories\Product;

use App\Models\Product\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 5000),
            'customer_id' => $this->faker->numberBetween(1, 1000),
            'title' => $this->faker->sentence(5, true),
            'answer' => $this->faker->paragraph,
        ];
    }
}
