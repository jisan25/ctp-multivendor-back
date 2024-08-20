<?php

namespace Database\Seeders\Product;

use App\Models\Product\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Review::create([
        //     'product_id' => 1,
        //     'customer_id' => 1,
        //     'rating' => 4,
        //     'comment' => 'Good Product',
        // ]);

        // Review::create([
        //     'product_id' => 2,
        //     'customer_id' => 1,
        //     'rating' => 2,
        //     'comment' => 'Not Bad Product',
        // ]);

        // Review::create([
        //     'product_id' => 3,
        //     'customer_id' => 2,
        //     'rating' => 1,
        //     'comment' => 'Bad Product',
        // ]);

        // Review::create([
        //     'product_id' => 4,
        //     'customer_id' => 1,
        //     'rating' => 5,
        //     'comment' => 'Awesome Product',
        // ]);

        // Review::create([
        //     'product_id' => 4,
        //     'customer_id' => 3,
        //     'rating' => 3,
        //     'comment' => 'Better Quality',
        // ]);

        Review::factory()->count(100)->create();
    }
}
