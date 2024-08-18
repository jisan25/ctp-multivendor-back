<?php

namespace App\Http\Controllers\api\v1\Admin;

use App\Helpers\ImageHelper;
use App\Models\Vendor\Store;
use App\Models\Vendor\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Requests\Auth\VendorRequest;
use App\Http\Requests\Vendor\StoreRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class StoreController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        $query = Store::query()->with('vendor')->withCount('products');


        $search_columns = ["store_name", "store_phone", "vendor_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

  

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $data = $store->load('vendor');
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        try {
            $validated = $request->validated();
            // Handle file upload for store_logo
            if ($request->hasFile('store_logo')) {
                ImageHelper::deleteOldImage('store-logos/', $store->store_logo);
                $imageName = ImageHelper::storeImage($request->file('store_logo'), 'images/store-logos');
                $validated['store_logo'] = $imageName;
            }

            // Update vendor data using mass assignment
            $store->update([
                'store_name' => $validated['store_name'],
                'store_description' => $validated['store_description'],
                'store_address' => $validated['store_address'],
                'store_phone' => $validated['store_phone'],
                'status' => $validated['status'],
                'store_logo' => $validated['store_logo'] ?? $store->store_logo, // Use existing logo if no new one is uploaded
            ]);

            return response()->json(['message' => 'Vendor Store updated successfully', 'vendor_store' => $store]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return $this->successResponse('Store Deleted Successfully', ['store' => null]);
    }
}
