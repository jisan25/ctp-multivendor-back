<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductAttribute::create([
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 1,
            'quantity' => 10,
        ]);

        ProductAttribute::create([
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 2,
            'quantity' => 5,
        ]);
        ProductAttribute::create([
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 3,
            'quantity' => 20,
        ]);

        ProductAttribute::create([
            'product_id' => 2,
            'color_id' => 2,
            'size_id' => 1,
            'quantity' => 12,
        ]);

        ProductAttribute::create([
            'product_id' => 2,
            'color_id' => 3,
            'size_id' => 1,
            'quantity' => 30,
        ]);
        ProductAttribute::create([
            'product_id' => 2,
            'color_id' => 2,
            'size_id' => 2,
            'quantity' => 25,
        ]);

        ProductAttribute::create([
            'product_id' => 3,
            'color_id' => 1,
            'size_id' => 1,
            'quantity' => 7,
        ]);

        ProductAttribute::create([
            'product_id' => 3,
            'color_id' => 1,
            'size_id' => 2,
            'quantity' => 3,
        ]);
        ProductAttribute::create([
            'product_id' => 3,
            'color_id' => 3,
            'size_id' => 3,
            'quantity' => 5,
        ]);
    }
}
