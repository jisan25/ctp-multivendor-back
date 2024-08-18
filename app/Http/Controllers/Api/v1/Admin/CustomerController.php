<?php

namespace App\Http\Controllers\Api\v1\Admin;


use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorFilterRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Customer::query();

        $search_columns = ["full_name", "email", "phone"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer = $customer->load('user');
        return $this->successResponse('Data Retrieved Successfully', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->successResponse('Customer deleted successfully', ['customer' => null]);
    }
}
