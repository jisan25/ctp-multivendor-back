<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\Product\CategoryRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Category::query()->with('descendants', 'parent_category');
        $search_columns = ["category_name"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }
    public function getCategories($type)
    {
        $data = Category::where('type', $type)->with('descendants')->get();
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function getCategoryTypes()
    {
        $data = Category::select('type')->distinct()->get();
        return $this->successResponse('Data Retrieved Successfully', ['category_types' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $validated = $request->validated();

            $category = Category::create($validated);
            return $this->successResponse('Category created successfully', ['category' => $category]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while creating the category.', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = $category->load('descendants', 'parent_category');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $validated = $request->validated();
            $category->update($validated);
            return $this->successResponse('Category updated successfully', ['category' => $category]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating the category.', $e);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse('Category deleted successfully', ['category' => null]);
    }
}
