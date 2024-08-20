<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Models\Product\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;


class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Order::query()->with('customer', 'store');

        $search_columns = ["customer_id", "order_id", "store_id"];


        $this->applyFilterSortSearch($search_columns, $query, $request);
        $data = $query->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = $order->load('customer', 'store');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $order]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->successResponse('Order deleted successfully', ['order' => null]);
    }
}
