<?php

namespace App\Http\Controllers\Api\v1\Customer;

use App\Models\Product\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\VendorFilterRequest;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {

        $query = Review::where('customer_id', Auth::id());

        $filterCols = ["rating"];

        $search_columns = [];

        $this->applyFilterSortSearch($filterCols, $search_columns, $query, $request);

        $data = $query->with('product.store')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['customer_reviews' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {

        try {
            $validated = $request->validated();
            $review = Review::create([
                'product_id' => $validated['product_id'],
                'customer_id' => Auth::id(),
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            return $this->successResponse('Review Posted Successfully', ['review' => $review]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while posting review.', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $data = $review->load('product.store');
        return $this->successResponse('Data Retrieved Successfully', ['review' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        try {
            $validated = $request->validated();

            $review->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);

            return $this->successResponse('Data Updated Successfully', ['review' => $review]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return $this->successResponse('Data Deleted Successfully', ['review' => null]);
    }
}
