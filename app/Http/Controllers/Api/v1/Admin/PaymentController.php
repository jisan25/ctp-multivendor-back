<?php

namespace App\Http\Controllers\api\v1\Admin;

use App\Models\Product\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Payment::query()->with('order.customer');


        $search_columns = ["order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $data = $payment->load('order.customer');
        return $this->successResponse('Data Retrieved Successfully', ['payment' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return $this->successResponse('Payment deleted successfully', ['payment' => null]);
    }
}
