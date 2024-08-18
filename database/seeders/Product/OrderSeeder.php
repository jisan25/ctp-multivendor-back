<?php

namespace Database\Seeders\Product;

use App\Models\Product\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Order::create([
        //     'order_id' => 2024661,
        //     'customer_id' => 1,
        //     'total_amount' => 1500,
        //     'type' => 'Online',
        //     'status' => 'Order Placed',
        //     'store_id' => 1
        // ]);

        // Order::create([
        //     'order_id' => 2024662,
        //     'customer_id' => 2,
        //     'total_amount' => 640,
        //     'type' => 'POS',
        //     'status' => 'Order Verified',
        //     'store_id' => 2
        // ]);

        // Order::create([
        //     'order_id' => 2024663,
        //     'customer_id' => 3,
        //     'total_amount' => 420,
        //     'type' => 'Online',
        //     'status' => 'Order Ready to Ship',
        //     'store_id' => 3
        // ]);

        // Order::create([
        //     'order_id' => 2024664,
        //     'customer_id' => 3,
        //     'total_amount' => 1000,
        //     'type' => 'POS',
        //     'status' => 'Order Handover to Courier',
        //     'store_id' => 3
        // ]);

        // Order::create([
        //     'order_id' => 2024665,
        //     'customer_id' => 4,
        //     'total_amount' => 2000,
        //     'type' => 'Online',
        //     'status' => 'Order Delivered',
        //     'store_id' => 4
        // ]);

        // Order::create([
        //     'order_id' => 2024666,
        //     'customer_id' => 4,
        //     'total_amount' => 70,
        //     'type' => 'POS',
        //     'status' => 'Order Cancelled',
        //     'store_id' => 4
        // ]);
        Order::factory()->count(1000)->create();
    }
}
