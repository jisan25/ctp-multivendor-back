<?php

namespace App\Http\Controllers\api\v1\Admin;

use App\Models\Product\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Review::query()->with('product.category', 'customer');


        $search_columns = ["product_id", "customer_id"];


        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review = $review->load('product', 'customer');
        return $this->successResponse('Data Retrieved Successfully', ['review' => $review]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return $this->successResponse('Review deleted successfully', ['review' => null]);
    }
}
