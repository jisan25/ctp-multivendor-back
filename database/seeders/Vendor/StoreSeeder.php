<?php

namespace Database\Seeders\Vendor;

use App\Models\Vendor\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $stores = [
        //     [
        //         'vendor_id' => 1,
        //         'store_name' => 'Vendor Store One',
        //         'store_description' => 'Description for Vendor Store One',
        //         'store_logo' => '/images/store-logos/vendor_one_logo.png',
        //         'store_address' => '10 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221133',
        //         'status' => 1
        //     ],
        //     [
        //         'vendor_id' => 1,
        //         'store_name' => 'Vendor Store Two',
        //         'store_description' => 'Description for Vendor Store Two',
        //         'store_logo' => '/images/store-logos/vendor_two_logo.png',
        //         'store_address' => '22 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221134',
        //         'status' => 1

        //     ],


        //     [
        //         'vendor_id' => 2,
        //         'store_name' => 'Vendor Store Three',
        //         'store_description' => 'Description for Vendor Store Three',
        //         'store_logo' => '/images/store-logos/vendor_three_logo.png',
        //         'store_address' => '30 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221135',
        //         'status' => 1

        //     ],
        //     [
        //         'vendor_id' => 2,
        //         'store_name' => 'Vendor Store Four',
        //         'store_description' => 'Description for Vendor Store Four',
        //         'store_logo' => '/images/store-logos/vendor_four_logo.png',
        //         'store_address' => '40 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221136',
        //         'status' => 1

        //     ],
        //     [
        //         'vendor_id' => 2,
        //         'store_name' => 'Vendor Store Five',
        //         'store_description' => 'Description for Vendor Store Five',
        //         'store_logo' => '/images/store-logos/vendor_five_logo.png',
        //         'store_address' => '50 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221137',
        //         'status' => 1
        //     ],



        //     [
        //         'vendor_id' => 3,
        //         'store_name' => 'Vendor Store Six',
        //         'store_description' => 'Description for Vendor Store Six',
        //         'store_logo' => '/images/store-logos/vendor_six_logo.png',
        //         'store_address' => '60 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221138',
        //         'status' => 1
        //     ],
        //     [
        //         'vendor_id' => 3,
        //         'store_name' => 'Vendor Store Seven',
        //         'store_description' => 'Description for Vendor Store Seven',
        //         'store_logo' => '/images/store-logos/vendor_seven_logo.png',
        //         'store_address' => '70 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221139',
        //         'status' => 1
        //     ],
        //     [
        //         'vendor_id' => 3,
        //         'store_name' => 'Vendor Store Eight',
        //         'store_description' => 'Description for Vendor Store Eight',
        //         'store_logo' => '/images/store-logos/vendor_eight_logo.png',
        //         'store_address' => '80 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221140',
        //         'status' => 1
        //     ],
        //     [
        //         'vendor_id' => 4,
        //         'store_name' => 'Vendor Store Nine',
        //         'store_description' => 'Description for Vendor Store Nine',
        //         'store_logo' => '/images/store-logos/vendor_nine_logo.png',
        //         'store_address' => '90 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221141',
        //         'status' => 1
        //     ],
        //     [
        //         'vendor_id' => 5,
        //         'store_name' => 'Vendor Store Ten',
        //         'store_description' => 'Description for Vendor Store Ten',
        //         'store_logo' => '/images/store-logos/vendor_ten_logo.png',
        //         'store_address' => '100 Mirpur Road, Kolabagan, Dhaka',
        //         'store_phone' => '01847 221142',
        //         'status' => 1
        //     ],

        // ];
        // foreach ($stores as $store) {
        //     Store::create($store);
        // }
        Store::factory()->count(100)->create();
    }
}
