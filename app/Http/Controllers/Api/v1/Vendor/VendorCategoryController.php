<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorCategoryController extends Controller
{
    public function index(VendorFilterRequest $request)
    {
        $query = Category::query()->with('descendants', 'parent_category');
        $search_columns = ["category_name"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function categoryList()
    {
        $data = Category::where('type', 'category')->with('descendants')->get();
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }
}
