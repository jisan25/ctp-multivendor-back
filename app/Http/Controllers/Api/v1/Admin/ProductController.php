<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Product::query()->with('store', 'category');


        $search_columns = ["product_name", "store_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = $product->load('store');
        return $this->successResponse('Data Retrieved Successfully', ['product' => $data]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successResponse('Product deleted successfully', ['product' => null]);
    }
}
