<?php

namespace App\Http\Controllers\Api\v1\Vendor;


use App\Helpers\MethodHelper;
use App\Models\Product\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;


class VendorReviewController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Review::whereIn('product_id', MethodHelper::getVendorProductIds());

        $search_columns = ["product_id", "customer_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->with('product', 'customer')->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $my_review)
    {
        $data = $my_review->load('product', 'customer');
        return $this->successResponse('Data Retrieved Successfully', ['review' => $data]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $my_review)
    {

        $my_review->delete();
        return $this->successResponse('Data Deleted Successfully', ['review' => null]);
    }
}
