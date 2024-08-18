<?php

namespace Database\Seeders\Product;

use App\Models\Product\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::create([
            'name' => 'Red',
        ]);
        Color::create([
            'name' => 'Green',
        ]);
        Color::create([
            'name' => 'Yellow',
        ]);
        Color::create([
            'name' => 'Black',
        ]);
    }
}
