<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product\Category;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::with('descendants')->where('type', 'category')->get();
        return $this->successResponse('Data Retrieved Successfully', ['all_categories' => $data]);
    }

    public function category($type)
    {
        $data = Category::where('type', $type)->with('descendants')->get();
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function categoryTypes()
    {
        $data = Category::select('type')->distinct()->get();
        return $this->successResponse('Data Retrieved Successfully', ['categories' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = $category->load('descendants');
        return $this->successResponse('Data Retrieved Successfully', ['category' => $category]);
    }
}
