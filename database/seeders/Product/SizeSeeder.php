<?php

namespace Database\Seeders\Product;

use App\Models\Product\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => 'S',
        ]);
        Size::create([
            'name' => 'M',
        ]);
        Size::create([
            'name' => 'L',
        ]);
        Size::create([
            'name' => 'XL',
        ]);
    }
}
