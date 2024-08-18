<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\ImageHelper;
use App\Models\Vendor\Store;
use App\Models\Vendor\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Requests\Auth\VendorRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;
use App\Http\Requests\Vendor\VendorProfileRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Vendor::query()->with('stores');

        $search_columns = ["full_name", "email"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        $vendor = $vendor->load('stores');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $vendor]);
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        try {
            $validated = $request->validated();

            $vendor = Vendor::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => 1
            ]);

            $data = [
                'vendor_id' => $vendor->id,
                'store_name' => $validated['store_name'],
                'store_description' => $validated['store_description'],
                'store_address' => $validated['store_address'],
                'store_phone' => $validated['store_phone'],
                'status' => 1
            ];
            if ($request->hasFile('store_logo')) {
                $imageName = ImageHelper::storeImage($request->file('store_logo'), 'images/store-logos');
                $data['store_logo'] = $imageName;
            }
            Store::create($data);
            return $this->successResponse('Store Created Successfully', ['data' => $data]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while registrering vendor Store.', $e);
        }
    }


    public function update(VendorProfileRequest $request, Vendor $vendor)
    {

        try {

            $validated = $request->validated();
            $updateData = [
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'status' => $validated['status']
            ];

            if (isset($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            // Update vendor data using mass assignment
            $vendor->update($updateData);


            return $this->successResponse('Vendor Profile updated Successfully', ['vendor' => $vendor]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return $this->successResponse('Vendor deleted successfully', ['vendor' => null]);
    }
}
