<?php

namespace Database\Seeders\Customer;

use Illuminate\Database\Seeder;
use App\Models\Customer\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $customers = [
        //     [
        //         'full_name' => 'Farjana Akter',
        //         'email' => 'customer1@gmail.com',
        //         'password' => Hash::make('cpassword1'),
        //         'phone' => '01654 123211',
        //         'division_id' => 1,
        //         'district_id' => 1,
        //         'upazila_id' => 1,
        //         'address' => 'Khilkhet Road, Moddo Para, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Akash Rahman',
        //         'email' => 'customer2@gmail.com',
        //         'password' => Hash::make('cpassword2'),
        //         'phone' => '01754 123212',
        //         'division_id' => 1,
        //         'district_id' => 1,
        //         'upazila_id' => 1,
        //         'address' => 'Banani Road, Block D, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Shirin Sultana',
        //         'email' => 'customer3@gmail.com',
        //         'password' => Hash::make('cpassword3'),
        //         'phone' => '01854 123213',
        //         'division_id' => 2,
        //         'district_id' => 2,
        //         'upazila_id' => 2,
        //         'address' => 'Uttara Road, Sector 3, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Jannat Ara',
        //         'email' => 'customer4@gmail.com',
        //         'password' => Hash::make('cpassword4'),
        //         'phone' => '01954 123214',
        //         'division_id' => 3,
        //         'district_id' => 3,
        //         'upazila_id' => 3,
        //         'address' => 'Gulshan Road, Circle 2, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Sakib Al Hasan',
        //         'email' => 'customer5@gmail.com',
        //         'password' => Hash::make('cpassword5'),
        //         'phone' => '01554 123215',
        //         'division_id' => 4,
        //         'district_id' => 4,
        //         'upazila_id' => 4,
        //         'address' => 'Dhanmondi Road, Sector 4, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Tanjim Islam',
        //         'email' => 'customer6@gmail.com',
        //         'password' => Hash::make('cpassword6'),
        //         'phone' => '01654 123216',
        //         'division_id' => 5,
        //         'district_id' => 5,
        //         'upazila_id' => 5,
        //         'address' => 'Mohakhali Road, Block A, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Fahmida Rahman',
        //         'email' => 'customer7@gmail.com',
        //         'password' => Hash::make('cpassword7'),
        //         'phone' => '01754 123217',
        //         'division_id' => 6,
        //         'district_id' => 6,
        //         'upazila_id' => 6,
        //         'address' => 'Bashundhara Road, Block C, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Tanvir Ahmed',
        //         'email' => 'customer8@gmail.com',
        //         'password' => Hash::make('cpassword8'),
        //         'phone' => '01854 123218',
        //         'division_id' => 1,
        //         'district_id' => 7,
        //         'upazila_id' => 7,
        //         'address' => 'Mirpur Road, Section 7, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Rumana Islam',
        //         'email' => 'customer9@gmail.com',
        //         'password' => Hash::make('cpassword9'),
        //         'phone' => '01954 123219',
        //         'division_id' => 2,
        //         'district_id' => 8,
        //         'upazila_id' => 8,
        //         'address' => 'Tejgaon Road, Industrial Area, Dhaka',

        //     ],
        //     [
        //         'full_name' => 'Arifur Rahman',
        //         'email' => 'customer10@gmail.com',
        //         'password' => Hash::make('cpassword10'),
        //         'phone' => '01554 123220',
        //         'division_id' => 3,
        //         'district_id' => 9,
        //         'upazila_id' => 9,
        //         'address' => 'Malibagh Road, Block B, Dhaka',

        //     ],
        // ];

        // foreach ($customers as $customer) {
        //     Customer::create($customer);
        // }
        // Create 1000 customers using the factory
        Customer::factory()->count(100)->create();
    }
}
