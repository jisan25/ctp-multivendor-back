<?php

namespace Database\Seeders\Customer;

use Illuminate\Database\Seeder;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'full_name' => 'Farjana Akter',
                'email' => 'customer1@gmail.com',
                'password' => Hash::make('cpassword1'),
                'phone' => '01654 123211',
                'division_id' => 1,
                'district_id' => 1,
                'upazila_id' => 1,
                'address' => 'Khilkhet Road, Moddo Para, Dhaka',

            ],
            [
                'full_name' => 'Akash Rahman',
                'email' => 'customer2@gmail.com',
                'password' => Hash::make('cpassword2'),
                'phone' => '01754 123212',
                'division_id' => 1,
                'district_id' => 1,
                'upazila_id' => 1,
                'address' => 'Banani Road, Block D, Dhaka',

            ],
            [
                'full_name' => 'Shirin Sultana',
                'email' => 'customer3@gmail.com',
                'password' => Hash::make('cpassword3'),
                'phone' => '01854 123213',
                'division_id' => 2,
                'district_id' => 2,
                'upazila_id' => 2,
                'address' => 'Uttara Road, Sector 3, Dhaka',

            ]

        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
        // Create 1000 customers using the factory
        Customer::factory()->count(100)->create();
    }
}
