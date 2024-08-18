<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\MethodHelper;
use App\Models\Product\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\PaymentRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {

        $query = Payment::whereIn('order_id', MethodHelper::getVendorOrderIds());

        $search_columns = ["order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->with('order.customer')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Payment $my_payment)
    {
        $data = $my_payment->load('order.customer');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    public function update(PaymentRequest $request, Payment $my_payment)
    {
        try {
            $validated = $request->validated();
            if ($my_payment->payment_method == 'CASH') {
                $my_payment->update([
                    'status' => $validated['status']
                ]);
                return $this->successResponse('Payment status updated successfully', ['payment' => $my_payment]);
            }
            return $this->errorResponse('You are unathorized.', null, 401);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }
}
