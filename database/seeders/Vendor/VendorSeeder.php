<?php

namespace Database\Seeders\Vendor;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $vendors = [
        //     [
        //         'full_name' => 'Abdul Khalek',
        //         'email' => 'vendor1@gmail.com',
        //         'password' => Hash::make('vpassword1'),
        //         'status' => 1
        //     ],
        //     [
        //         'full_name' => 'Rahim Uddin',
        //         'email' => 'vendor2@gmail.com',
        //         'password' => Hash::make('vpassword2'),
        //         'status' => 0
        //     ],
        //     [
        //         'full_name' => 'Karim Ali',
        //         'email' => 'vendor3@gmail.com',
        //         'password' => Hash::make('vpassword3'),
        //         'status' => 1
        //     ],
        //     [
        //         'full_name' => 'Sajid Hasan',
        //         'email' => 'vendor4@gmail.com',
        //         'password' => Hash::make('vpassword4'),
        //         'status' => 0
        //     ],
        //     [
        //         'full_name' => 'Hasan Mahmud',
        //         'email' => 'vendor5@gmail.com',
        //         'password' => Hash::make('vpassword5'),
        //         'status' => 0
        //     ]
        // ];

        // foreach ($vendors as $vendor) {
        //     Vendor::create($vendor);
        // }
        Vendor::factory()->count(200)->create();
    }
}
