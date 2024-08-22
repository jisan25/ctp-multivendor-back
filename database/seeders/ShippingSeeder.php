<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        $divisions = [
            'Dhaka',
            'Chattogram',
            'Khulna',
            'Barishal',
            'Sylhet',
            'Rajshahi',
            'Rangpur',
            'Mymensingh'
        ];

        $cities = [
            'Dhaka',
            'Chattogram',
            'Khulna',
            'Barishal',
            'Sylhet',
            'Rajshahi',
            'Rangpur',
            'Mymensingh',
            'Comilla',
            'Narayanganj',
            'Gazipur',
            'Narsingdi',
            'Jessore',
            'Cox\'s Bazar',
            'Pabna',
            'Bogra',
            'Sirajganj',
            'Feni',
            'Lalmonirhat',
            'Tangail'
        ];


        foreach (range(1, 20) as $index) {
            DB::table('shippings')->insert([
                'customer_id' => $index,
                'division' => $faker->randomElement($divisions),
                'city' => $faker->randomElement($cities),
                'address' => $faker->address,
                'type' => 'home',
            ]);

            DB::table('shippings')->insert([
                'customer_id' => $index,
                'division' => $faker->randomElement($divisions),
                'city' => $faker->randomElement($cities),
                'address' => $faker->address,
                'type' => 'office',
            ]);
        }
    }
}
