<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\OrderDetails;
use App\Http\Requests\Vendor\VendorFilterRequest;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = OrderDetails::query()->with('order.customer', 'product.store', 'product.category');


        $search_columns = ["product_id", "order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);
        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $order_detail)
    {
        $order_detail = $order_detail->load('order.customer', 'product.store', 'product.category');
        return $this->successResponse('Data Retrieved Successfully', ['order_details' => $order_detail]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetails $order_detail)
    {
        $order_detail->delete();
        return $this->successResponse('Order Details deleted successfully', ['order_details' => null]);
    }
}
