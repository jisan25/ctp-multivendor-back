<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductVariantImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVariantImage::create([
            'product_id' => 1,
            'color_id' => 1,
            'variant_image' => 'images/products/red-t-shirts.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 1,
            'color_id' => 2,
            'variant_image' => 'images/products/green-t-shirt.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 1,
            'color_id' => 3,
            'variant_image' => 'images/products/yellow-t-shirt.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 1,
            'color_id' => 4,
            'variant_image' => 'images/products/black-t-shirt.jpg',
        ]);


        ProductVariantImage::create([
            'product_id' => 2,
            'color_id' => 1,
            'variant_image' => 'images/products/red-t-shirts.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 2,
            'color_id' => 2,
            'variant_image' => 'images/products/green-t-shirt.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 3,
            'color_id' => 3,
            'variant_image' => 'images/products/yellow-t-shirt.jpg',
        ]);
        ProductVariantImage::create([
            'product_id' => 3,
            'color_id' => 4,
            'variant_image' => 'images/products/black-t-shirt.jpg',
        ]);
    }
}
