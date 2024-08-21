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
        $vendors = [
            [
                'full_name' => 'Abdul Khalek',
                'email' => 'vendor1@gmail.com',
                'password' => Hash::make('vpassword1'),
                'status' => 1
            ],
            [
                'full_name' => 'Rahim Uddin',
                'email' => 'vendor2@gmail.com',
                'password' => Hash::make('vpassword2'),
                'status' => 1
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }
        Vendor::factory()->count(100)->create();
    }
}
