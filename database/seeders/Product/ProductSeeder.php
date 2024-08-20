<?php

namespace Database\Seeders\Product;

use App\Models\Product\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Product::create([
        //     'store_id' => 1,
        //     'product_name' => 'Tangail Tat Multi color Cotton Saree With Running Blouse Piece for Women',
        //     'image' => '/images/products/1.webp',
        //     'description' => 'This saree is perfect for the young and smart lady which can be worn for any occasion. Women look very gorgeous in these colorful sarees, and so they love to wear it for different social and cultural functions. Soft material fabrics are used for making saree as it is supposed to be a comfort to wear. Saree has a traditional value in Bangladesh. The colorful saree will definitely make you look smart and stylish',
        //     'price' => 500,
        //     'stock_quantity' => 10,
        //     'category_id' => 10,
        //     'status' => 1,
        // ]);

        // Product::create([
        //     'store_id' => 2,
        //     'product_name' => 'One piece Kurti',
        //     'image' => '/images/products/2.webp',
        //     'description' => 'Introducing the one-piece kurti, crafted from luxurious pure cotton for unparalleled comfort throughout the day. This readymade kurti is designed to effortlessly transition from casual outings to daily errands with ease. The stylish addition of buttons on the sleeves adds an extra flair, elevating its appeal. Whether youre running errands, meeting friends, or simply enjoying a leisurely day, the  kurti promises both style and comfort in one elegant package.',
        //     'price' => 320,
        //     'stock_quantity' => 5,
        //     'category_id' => 11,
        //     'status' => 1,
        // ]);

        // Product::create([
        //     'store_id' => 3,
        //     'product_name' => 'Glam Touch - Premium Quality Full Coverage (80x30) Diamond Georgette Hijab',
        //     'image' => '/images/products/3.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 420,
        //     'stock_quantity' => 15,
        //     'category_id' => 12,
        //     'status' => 0,
        // ]);

        // Product::create([
        //     'store_id' => 3,
        //     'product_name' => 'Borka For Women Regular Use Outfit Pocket Borka',
        //     'image' => '/images/products/4.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 500,
        //     'stock_quantity' => 29,
        //     'category_id' => 13,
        //     'status' => 1,
        // ]);

        // Product::create([
        //     'store_id' => 4,
        //     'product_name' => 'Nokia 105 DS - 2023 (Official)',
        //     'image' => '/images/products/5.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 100,
        //     'stock_quantity' => 19,
        //     'category_id' => 14,
        //     'status' => 0,
        // ]);

        // Product::create([
        //     'store_id' => 4,
        //     'product_name' => 'Samsung Galaxy S24 Ultra 5G (12GB/256GB)',
        //     'image' => '/images/products/6.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 70,
        //     'stock_quantity' => 30,
        //     'category_id' => 15,
        //     'status' => 0,
        // ]);

        // Product::create([
        //     'store_id' => 3,
        //     'product_name' => 'Andormahal (MDF) Floral Headstand with Bed King Size',
        //     'image' => '/images/products/7.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 4000,
        //     'stock_quantity' => 4,
        //     'category_id' => 16,
        //     'status' => 1,
        // ]);

        // Product::create([
        //     'store_id' => 3,
        //     'product_name' => 'Back Rest Comfortable Car Seat & Office Chair Massage Back Lumbar Support Black',
        //     'image' => '/images/products/8.webp',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus doloribus voluptatibus fugit error eos ipsum voluptatem tempore facilis quae illo? Voluptates expedita aspernatur sed aperiam ab a laudantium tempore error.',
        //     'price' => 100,
        //     'stock_quantity' => 70,
        //     'category_id' => 17,
        //     'status' => 0,
        // ]);

        // Create 5000 products using the factory
        Product::factory()->count(100)->create();
    }
}
