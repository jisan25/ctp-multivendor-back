<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ImageHelper;
use App\Models\Vendor\Store;
use Illuminate\Http\Request;
use App\Models\Vendor\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\Auth\VendorRequest;
use Illuminate\Validation\ValidationException;

class VendorAuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $vendor = Vendor::where('email', $request->email)->first();

        if ($vendor && $vendor->status == 0) {
            return $this->errorResponse('You are not verified.Please contact Admin.', null, 403);
        }

        if (!$vendor || !Hash::check($request->password, $vendor->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'message' => 'Login Successful.',
            'token' => $vendor->createToken('authToken', ['role:vendor'])->plainTextToken
        ]);
    }

    public function register(VendorRequest $request)
    {
        try {
            $validated = $request->validated();

            $vendor = Vendor::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => 0
            ]);

            $data = [
                'vendor_id' => $vendor->id,
                'store_name' => $validated['store_name'],
                'store_description' => $validated['store_description'],
                'store_address' => $validated['store_address'],
                'store_phone' => $validated['store_phone'],
                'status' => 0
            ];
            if ($request->hasFile('store_logo')) {
                $imageName = ImageHelper::storeImage($request->file('store_logo'), 'images/store-logos');
                $data['store_logo'] = $imageName;
            }
            Store::create($data);
            return $this->successResponse('Vendor Registration is under review. Wait for an admin approval', ['vendor' => $vendor]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while registrering vendor.', $e);
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
