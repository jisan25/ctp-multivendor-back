<?php

namespace Database\Seeders\Product;

use App\Models\Product\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // categories

        Category::create([
            'category_name' => 'Fashion',
            'parent_category_id' => null,
            'image' => 'images/category/1.webp',
            'type' => 'category',
        ]);

        Category::create([
            'category_name' => 'Electronics',
            'parent_category_id' => null,
            'image' => 'images/category/2.jpeg',
            'type' => 'category',
        ]);
        Category::create([
            'category_name' => 'Books',
            'parent_category_id' => null,
            'image' => 'images/category/Stack-books.webp',
            'type' => 'category',
        ]);
        Category::create([
            'category_name' => 'Food & Grocery',
            'parent_category_id' => null,
            'image' => 'images/category/220923085337-food-inflation-habits-lisa-altman.jpg',
            'type' => 'category',
        ]);
        Category::create([
            'category_name' => 'Pharmacy',
            'parent_category_id' => null,
            'image' => 'images/category/pharmaceutical-industry.jpg',
            'type' => 'category',
        ]);


        // sub categories

        // --- fashion
        Category::create([
            'category_name' => 'Sarees',
            'parent_category_id' => 1,
            'image' => 'images/category/saree.jpeg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Shirt',
            'parent_category_id' => 1,
            'image' => 'images/category/63bc2fb22e02f-square.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Tshirt',
            'parent_category_id' => 1,
            'image' => 'images/category/bangladesh-flag-cotton-tshirt.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Salowar',
            'parent_category_id' => 1,
            'image' => 'images/category/0477756_women-cotton-salwar-kameez.jpeg',
            'type' => 'sub_category',
        ]);
        Category::create([
            'category_name' => 'Kurtis',
            'parent_category_id' => 1,
            'image' => 'images/category/kurti.jpg',
            'type' => 'sub_category',
        ]);
        Category::create([
            'category_name' => 'Hijabs',
            'parent_category_id' => 1,
            'image' => 'images/category/hijab.webp',
            'type' => 'sub_category',
        ]);
        Category::create([
            'category_name' => 'Long Dresses',
            'parent_category_id' => 1,
            'image' => 'images/category/rj2633.jpg',
            'type' => 'sub_category',
        ]);
        Category::create([
            'category_name' => 'Jeans',
            'parent_category_id' => 1,
            'image' => 'images/category/71S0IJB5JrL._AC_UF1000,1000_QL80_.jpg',
            'type' => 'sub_category',
        ]);

        // --- end fashion

        // --- electronics
        Category::create([
            'category_name' => 'Keyboard',
            'image' => 'images/category/keyboard.jpg',
            'parent_category_id' => 2,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Mouse',
            'image' => 'images/category/61M9TBM9HaL._AC_SL1500_.jpg',
            'parent_category_id' => 2,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Laptop',
            'image' => 'images/category/How-to-Choose-a-Laptop-August-2023-Gear.webp',
            'parent_category_id' => 2,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Mobile',
            'image' => 'images/category/71WlZWwsJvL._AC_SL1500_.jpg',
            'parent_category_id' => 2,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Headphone',
            'image' => 'images/category/xtrfy-h2-front_black_web.jpg',
            'parent_category_id' => 2,
            'type' => 'sub_category',
        ]);
        Category::create([
            'category_name' => 'TV',
            'parent_category_id' => 2,
            'image' => 'images/category/tv.avif',
            'type' => 'sub_category',
        ]);

        // --- end electronics

        // --- book category
        Category::create([
            'category_name' => 'Fiction',
            'parent_category_id' => 3,
            'image' => 'images/category/fiction.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Non-Fiction',
            'parent_category_id' => 3,
            'image' => 'images/category/non-fiction.webp',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Science Fiction',
            'parent_category_id' => 3,
            'image' => 'images/category/science-fiction.webp',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Biography',
            'parent_category_id' => 3,
            'image' => 'images/category/parts-of-a-biography_7abbbb2796.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Fantasy',
            'parent_category_id' => 3,
            'image' => 'images/category/fantasy.webp',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Mystery',
            'parent_category_id' => 3,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Historical Fiction',
            'parent_category_id' => 3,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Self-Help',
            'parent_category_id' => 3,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Poetry',
            'parent_category_id' => 3,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Thriller',
            'parent_category_id' => 3,
            'image' => null,
            'type' => 'sub_category',
        ]);

        // --- end book category

        // --- Food & Grocery
        Category::create([
            'category_name' => 'Fruits & Vegetables',
            'image' => 'images/category/fruits-and-vegetables_650x366_41486465566.webp',
            'parent_category_id' => 4,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Dairy & Eggs',
            'image' => 'images/category/milk-egg.jpg',
            'parent_category_id' => 4,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Meat & Seafood',
            'image' => 'images/category/pharmaceutical-industry.jpg',
            'parent_category_id' => 4,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Bakery & Bread',
            'image' => 'images/category/main-qimg-dd958c882be1ec7d02c8c9b97e9e7a44-lq.jpg',
            'parent_category_id' => 4,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Snacks & Sweets',
            'image' => 'images/category/sugary-snacks.webp',
            'parent_category_id' => 4,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Beverages',
            'parent_category_id' => 4,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Frozen Foods',
            'parent_category_id' => 4,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Pantry Staples',
            'parent_category_id' => 4,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Condiments & Spices',
            'parent_category_id' => 4,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Cereals & Breakfast',
            'parent_category_id' => 4,
            'image' => null,
            'type' => 'sub_category',
        ]);
        // --- end Food & Grocery


        // --- Pharmacy
        Category::create([
            'category_name' => 'Prescription Medicines',
            'parent_category_id' => 5,
            'image' => 'images/category/pharmaceutical-industry.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Over-the-Counter Medicines',
            'parent_category_id' => 5,
            'image' => 'images/category/63f4e2a32818959a83dc7bac_otc-medications.webp',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Vitamins & Supplements',
            'parent_category_id' => 5,
            'image' => 'images/category/vitamins-nutrition-supplements.webp',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'First Aid',
            'parent_category_id' => 5,
            'image' => 'images/category/first-aid-kit.jpg',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Personal Care',
            'parent_category_id' => 5,
            'image' => 'images/category/large_personal_items_list_6c4c450abf.png',
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Baby Care',
            'parent_category_id' => 5,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Health Devices',
            'parent_category_id' => 5,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Skin Care',
            'parent_category_id' => 5,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Oral Care',
            'parent_category_id' => 5,
            'image' => null,
            'type' => 'sub_category',
        ]);

        Category::create([
            'category_name' => 'Eye Care',
            'parent_category_id' => 5,
            'image' => null,
            'type' => 'sub_category',
        ]);

        // --- end Pharmacy

    }
}
