<?php

namespace Database\Seeders\Product;

use App\Models\Product\DeliveryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryType::create([
            'zone_name' => 'Inside Dhaka',
            'amount' => 60,
        ]);

        DeliveryType::create([
            'zone_name' => 'Outside Dhaka',
            'amount' => 120,
        ]);
    }
}
