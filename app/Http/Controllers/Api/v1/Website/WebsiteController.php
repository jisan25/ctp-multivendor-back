<?php

namespace App\Http\Controllers\Api\v1\Website;

use App\Models\Product\Size;
use Illuminate\Http\Request;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('descendants')->where('type', 'category')->get();
        $allCategories = Category::whereNotNull('image')->inRandomOrder()->take(20)->get();
        $productCategories = Category::take(20)->get();
        $products = Product::with('reviews')->take(20)->get();
        $randomCategory1 = Category::whereNotNull('image')->inRandomOrder()->take(4)->get();
        $randomCategory2 = Category::whereNotNull('image')->inRandomOrder()->take(4)->get();
        $randomCategory3 = Category::whereNotNull('image')->inRandomOrder()->take(4)->get();
        $data = [
            'products' => $products,
            'categories' => $categories,
            'allCategories' => $allCategories,
            'randomCategory1' => $randomCategory1,
            'randomCategory2' => $randomCategory2,
            'randomCategory3' => $randomCategory3,
            'productCategories' => $productCategories
        ];
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        $data = Product::findOrFail($product)->load('store', 'reviews', 'category.descendants', 'gallery');
        return $this->successResponse('Data Retrieved Successfully', ['product' => $data]);
    }

    public function productAttributes()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $data = [
            'colors' => $colors,
            'sizes' => $sizes
        ];
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function getCategoryProducts($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = Product::where('category_id', $categoryId)->take(50)->get();

        $data = [
            'products' => $products,
            'category' => $category
        ];

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function getCartItems(Request $request)
    {
        $productIds = $request->input('ids');

        if (empty($productIds)) {
            return response()->json(['message' => 'No product IDs provided'], 400);
        }

        $products = Product::whereIn('id', $productIds)->get();

        return response()->json([
            'data' => [
                'products' => $products,
            ]
        ]);
    }
}
