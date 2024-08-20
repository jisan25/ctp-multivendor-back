<?php

namespace Database\Seeders\Product;

use App\Models\Product\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Question::create([
        //     'product_id' => 1,
        //     'customer_id' => 1,
        //     'title' => 'Product Question 1',
        //     'answer' => 'Product Question Answer 1',
        // ]);

        // Question::create([
        //     'product_id' => 2,
        //     'customer_id' => 1,
        //     'title' => 'Product Question 2',
        //     'answer' => 'Product Question Answer 2'
        // ]);

        // Question::create([
        //     'product_id' => 3,
        //     'customer_id' => 2,
        //     'title' => 'Product Question 3',
        //     'answer' => 'Product Question Answer 3',
        // ]);

        // Question::create([
        //     'product_id' => 4,
        //     'customer_id' => 2,
        //     'title' => 'Product Question 4',
        //     'answer' => 'Product Question Answer 4',
        // ]);

        // Question::create([
        //     'product_id' => 5,
        //     'customer_id' => 3,
        //     'title' => 'Product Question 5',
        //     'answer' => 'Product Question Answer 5',
        // ]);

        // Question::create([
        //     'product_id' => 6,
        //     'customer_id' => 2,
        //     'title' => 'Product Question 6',
        //     'answer' => 'Product Question Answer 6',

        // ]);

        Question::factory()->count(100)->create();
    }
}
