<?php

namespace App\Http\Controllers\Api\v1\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\MethodHelper;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
use Illuminate\Database\QueryException;

class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customer_id = MethodHelper::getCustomerId();
        $data = Customer::with('division', 'district', 'upazila')->findOrFail(Auth::id());
        return $this->successResponse('Data Retrieved Successfully', ['profile' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = [
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                // 'division_id' => $validated['division_id'],
                // 'district_id' => $validated['district_id'],
                // 'upazila_id' => $validated['upazila_id'],
            ];

            // if (isset($validated['password']) && !empty($validated['password'])) {
            //     $data['password'] = Hash::make($validated['password']);
            // }

            $customer = MethodHelper::getCustomer();
            $customer->update($data);

            return $this->successResponse('Data Updated Successfully', ['profile' => $customer]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            // Validate the input
            $request->validate([
                'current_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            // Get the currently authenticated customer
            $customer = MethodHelper::getCustomer();

            // Check if the current password matches the one in the database
            if (!Hash::check($request->current_password, $customer->password)) {
                return response()->json([
                    'message' => 'Current password is incorrect.',
                    'errors' => ['current_password' => ['Current password is incorrect.']],
                ], 422);
            }

            // Update the customer's password
            $customer->update([
                'password' => Hash::make($request->new_password),
            ]);

            return $this->successResponse('Password updated successfully.');

        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating the password.', $e);
        }
    }
}
