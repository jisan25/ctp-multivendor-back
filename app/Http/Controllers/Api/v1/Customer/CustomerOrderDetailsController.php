<?php

namespace App\Http\Controllers\Api\v1\Customer;


use App\Helpers\MethodHelper;
use App\Http\Controllers\Controller;
use App\Models\Product\OrderDetails;
use App\Http\Requests\Vendor\VendorFilterRequest;


class CustomerOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = OrderDetails::whereIn('order_id', MethodHelper::getCustomerOrderIds());

        $filterCols = ["delivery_fee"];

        $search_columns = ["order_id"];

        $this->applyFilterSortSearch($filterCols, $search_columns, $query, $request);

        $data = $query->with('order', 'product.store')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['customer_order_details' => $data]);
    }



    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $order_detail)
    {
        $data = $order_detail->load('order', 'product.store');
        return $this->successResponse('Data Retrieved Successfully', ['order_details' => $data]);
    }
}
