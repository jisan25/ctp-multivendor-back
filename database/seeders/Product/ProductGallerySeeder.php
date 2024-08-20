<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductGallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 2 !== 0) {
                // Odd-numbered product IDs
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery.jpg',
                ]);
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery-2.jpg',
                ]);
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery-3.jpg',
                ]);
            } else {
                // Even-numbered product IDs
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery-4.jpg',
                ]);
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery-5.jpg',
                ]);
                ProductGallery::create([
                    'product_id' => $i,
                    'product_image' => 'images/products/image-gallery-6.jpg',
                ]);
            }
        }

    }
}
