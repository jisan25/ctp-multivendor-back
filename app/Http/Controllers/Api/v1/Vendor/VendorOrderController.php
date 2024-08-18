<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\MethodHelper;
use App\Models\Product\Order;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\Product\OrderRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {

        $query = Order::whereIn('store_id', MethodHelper::getVendorStoreIds());

        $search_columns = ["customer_id", "order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show($my_order)
    {
        $data = Order::where('order_id', $my_order)
            ->with('orderDetails.product', 'customer.orders', 'customer.upazila', 'customer.district', 'customer.division', 'store', 'payment')->first();
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function update(OrderRequest $request, Order $my_order)
    {
        try {
            $validated = $request->validated();
            $my_order->update([
                'status' => $validated['status']
            ]);
            return $this->successResponse('Order status updated successfully', ['order' => $my_order]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }
}
