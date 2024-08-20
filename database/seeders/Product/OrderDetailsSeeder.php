<?php

namespace Database\Seeders\Product;

use App\Models\Product\OrderDetails;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**O
     * Run the database seeds.
     */
    public function run(): void
    {
        // OrderDetails::create([
        //     'order_id' => 2024661,
        //     'product_id' => 1,
        //     'quantity' => 3,
        //     'price' => 500,
        //     'delivery_fee' => 60,

        // ]);

        // OrderDetails::create([
        //     'order_id' => 2024662,
        //     'product_id' => 2,
        //     'quantity' => 2,
        //     'price' => 320,
        //     'delivery_fee' => 120,

        // ]);

        // OrderDetails::create([
        //     'order_id' => 2024663,
        //     'product_id' => 3,
        //     'quantity' => 1,
        //     'price' => 420,
        //     'delivery_fee' => 60,

        // ]);

        // OrderDetails::create([
        //     'order_id' => 2024664,
        //     'product_id' => 4,
        //     'quantity' => 2,
        //     'price' => 500,
        //     'delivery_fee' => 120,

        // ]);

        // OrderDetails::create([
        //     'order_id' => 2024665,
        //     'product_id' => 5,
        //     'quantity' => 20,
        //     'price' => 100,
        //     'delivery_fee' => 60,

        // ]);

        // OrderDetails::create([
        //     'order_id' => 2024666,
        //     'product_id' => 6,
        //     'quantity' => 1,
        //     'price' => 70,
        //     'delivery_fee' => 120,

        // ]);
        OrderDetails::factory()->count(100)->create();
    }
}
