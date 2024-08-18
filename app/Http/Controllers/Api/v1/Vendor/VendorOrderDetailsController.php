<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\MethodHelper;
use App\Models\Product\Order;
use App\Http\Controllers\Controller;
use App\Models\Product\OrderDetails;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = OrderDetails::whereIn('order_id', MethodHelper::getVendorOrderIds());

        $search_columns = ["product_id", "order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->with('order', 'product')->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $my_order_detail)
    {
        $data = $my_order_detail->load('order', 'product');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }
}
