<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Customer\CustomerSeeder;
use Database\Seeders\Product\CategorySeeder;
use Database\Seeders\Product\ColorSeeder;
use Database\Seeders\Product\DeliveryTypeSeeder;
use Database\Seeders\Product\OrderDetailsSeeder;
use Database\Seeders\Product\OrderSeeder;
use Database\Seeders\Product\PaymentSeeder;
use Database\Seeders\Product\ProductAttributeSeeder;
use Database\Seeders\Product\ProductGallerySeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Product\ProductVariantImageSeeder;
use Database\Seeders\Product\QuestionSeeder;
use Database\Seeders\Product\ReviewSeeder;
use Database\Seeders\Product\SizeSeeder;
use Database\Seeders\Vendor\StoreSeeder;
use Database\Seeders\Vendor\VendorSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            VendorSeeder::class,
            CustomerSeeder::class,
            CategorySeeder::class,
            DeliveryTypeSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
            QuestionSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductAttributeSeeder::class,
            ProductGallerySeeder::class,
            ProductVariantImageSeeder::class,
            SqlFileSeeder::class
        ]);
    }
}
