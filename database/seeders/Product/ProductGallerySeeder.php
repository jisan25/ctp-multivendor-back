<?php

namespace Database\Seeders\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductGallery;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Instantiate Faker

        for ($i = 1; $i <= 100; $i++) {
            // Fetch the product by ID
            $product = Product::find($i);

            if ($product) {
                for ($j = 0; $j < 3; $j++) {
                    if ($j === 0) {
                        // Use the product's actual image for the first item
                        $productImage = $product->image;
                    } else {
                        // Use a random image for the next two items
                        $productImage = 'images/products/' . $faker->numberBetween(1, 30) . '.webp';
                    }

                    ProductGallery::create([
                        'product_id' => $i,
                        'product_image' => $productImage,
                    ]);
                }
            }
        }
    }
}
