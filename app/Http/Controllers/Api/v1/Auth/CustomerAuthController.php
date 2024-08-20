<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    public function login(AuthRequest $request)
    {

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'message' => 'Login Successful.',
            'token' => $customer->createToken('authToken', ['role:customer'])->plainTextToken
        ]);
    }




    public function register(CustomerRequest $request)
    {
        try {
            $validated = $request->validated();

            $customer = Customer::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone'],
                // 'division_id' => $validated['division_id'],
                // 'district_id' => $validated['district_id'],
                // 'upazila_id' => $validated['upazila_id'],
                'address' => $validated['address'],
            ]);

            return $this->successResponse('Customer Registered Successfully', ['customer' => $customer]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while registrering customer.', $e);
        }
    }
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful.'
        ]);
    }
}
