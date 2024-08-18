<?php

namespace Database\Seeders\Product;

use App\Models\Product\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Payment::create([
        //     'order_id' => 2024661,
        //     'payment_method' => 'COD',
        //     'amount' => 1500,
        //     'status' => 'success',
        // ]);

        // Payment::create([
        //     'order_id' => 2024662,
        //     'payment_method' => 'CASH',
        //     'amount' => 640,
        //     'status' => 'success',
        // ]);

        // Payment::create([
        //     'order_id' => 2024663,
        //     'payment_method' => 'BKASH',
        //     'amount' => 420,
        //     'status' => 'pending',
        // ]);

        // Payment::create([
        //     'order_id' => 2024664,
        //     'payment_method' => 'BKASH',
        //     'amount' => 1000,
        //     'status' => 'failed',
        // ]);

        // Payment::create([
        //     'order_id' => 2024665,
        //     'payment_method' => 'COD',
        //     'amount' => 2000,
        //     'status' => 'pending',
        // ]);
        // Payment::create([
        //     'order_id' => 2024666,
        //     'payment_method' => 'COD',
        //     'amount' => 70,
        //     'status' => 'success',
        // ]);
        Payment::factory()->count(1000)->create();
    }
}
