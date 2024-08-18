<?php

namespace App\Http\Controllers\Api\v1\Vendor;


use App\Models\Vendor\Vendor;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {

        $query = Vendor::getCustomersForVendor(Auth::id());


        $search_columns = ["full_name", "email", "phone"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        // $data = Vendor::getCustomersForVendor(Auth::id());
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        try {
            $validated = $request->validated();

            // Create the customer
            $customer = Customer::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'],
                'division_id' => $validated['division_id'],
                'district_id' => $validated['district_id'],
                'upazila_id' => $validated['upazila_id'],
                'address' => $validated['address'],
            ]);

            return $this->successResponse('Customer stored Successfully', ['customer' => $customer]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while storing data.', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $my_customer)
    {
        return $this->successResponse('Data Retrieved Successfully', ['data' => $my_customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $my_customer)
    {
        try {
            $validated = $request->validated();

            $data = [
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'division_id' => $validated['division_id'],
                'district_id' => $validated['district_id'],
                'upazila_id' => $validated['upazila_id'],
                'address' => $validated['address']
            ];

            if (isset($validated['password']) && !empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $my_customer->update($data);

            return $this->successResponse('Customer updated successfully', ['customer' => $my_customer]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $my_customer)
    {
        $my_customer->delete();
        return response()->json(['message' => 'Customer deleted successfully', 'customer' => null]);
    }
}
