<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\ImageHelper;
use App\Models\Vendor\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Vendor\StoreRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {

        $query = Store::query()->withCount('products')->where('vendor_id', Auth::id());

        $search_columns = ["store_name", "store_phone"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $data = $query->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }
    public function storeList()
    {
        $data = Store::where('vendor_id', Auth::id())->get();
        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = [
                'vendor_id' => Auth::user()->id,
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
            return response()->json(['message' => 'Store Created Successfully', 'vendor_store' => $data]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while storing data.', $e);
        }
    }


    public function show(Store $my_store)
    {
        return $this->successResponse('Data Retrieved Successfully', ['data' => $my_store]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $my_store)
    {
        try {
            $validated = $request->validated();
            // Handle file upload for store_logo
            if ($request->hasFile('store_logo')) {
                ImageHelper::deleteOldImage('store-logos/', $my_store->store_logo);
                $imageName = ImageHelper::storeImage($request->file('store_logo'), 'images/store-logos');
                $validated['store_logo'] = $imageName;
            }

            // Update vendor data using mass assignment
            $my_store->update([
                'store_name' => $validated['store_name'],
                'store_description' => $validated['store_description'],
                'store_address' => $validated['store_address'],
                'store_phone' => $validated['store_phone'],
                'store_logo' => $validated['store_logo'] ?? $my_store->store_logo, // Use existing logo if no new one is uploaded
            ]);

            return response()->json(['message' => 'Store updated successfully', 'vendor_store' => $my_store]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while updating data.', $e);
        }
    }
}
