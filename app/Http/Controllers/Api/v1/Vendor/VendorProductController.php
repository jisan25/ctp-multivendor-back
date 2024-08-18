<?php

namespace App\Http\Controllers\Api\v1\Vendor;

use App\Helpers\ImageHelper;
use App\Models\Vendor\Store;
use Illuminate\Http\Request;
use App\Helpers\MethodHelper;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Models\Product\ProductGallery;
use Illuminate\Database\QueryException;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductVariantImage;
use App\Http\Requests\Vendor\VendorFilterRequest;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {
        // Retrieve the products for the vendor's stores where status = 1
        $query = Product::whereIn('store_id', MethodHelper::getVendorStoreIds());

        $search_columns = ["product_name"];

        $this->applyFilterSortSearch($search_columns, $query, $request);


        $data = $query->with('store', 'category')->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        try {
            $validated = $request->validated();

            $product = $this->createProduct($validated, $request);

            if ($request->hasFile('product_images')) {
                $this->handleProductImages($request->file('product_images'), $product->id);
            }
            if ($request->has('colorVariant')) {
                $this->handleVariantImages($request->colorVariant, $product->id);
            }

            if ($request->has('product_attributes')) {

                $productAttributes = json_decode($request->product_attributes, true);
                $this->handleProductAttributes($productAttributes, $product->id);
            }

            return $this->successResponse('Product Stored Successfully', ['product' => $product]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while storing product.', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $my_product)
    {
        $data = $my_product->load('store', 'reviews', 'category', 'attributes.color', 'attributes.size');
        return $this->successResponse('Data Retrieved Successfully', ['product' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $my_product)
    {
        try {
            $validated = $request->validated();
            $my_product->store_id = $validated['store_id'];
            $my_product->product_name = $validated['product_name'];
            if ($request->hasFile('image')) {
                ImageHelper::deleteOldImage('products/', $my_product->image);
                $imageName = ImageHelper::storeImage($request->file('image'), 'images/products');
                $my_product->image = $imageName;
            }
            $my_product->description = $validated['description'];
            $my_product->price = $validated['price'];
            $my_product->stock_quantity = $validated['stock_quantity'];
            $my_product->category_id = $validated['category_id'];
            $my_product->status = $validated['status'];
            $my_product->save();
            return $this->successResponse('Data Updated Successfully', ['product' => $my_product]);
        } catch (QueryException $e) {
            return $this->errorResponse('An error occurred while retrieving data.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $my_product)
    {
        $my_product->delete();
        return $this->successResponse('Product Deleted Successfully', ['product' => null]);
    }

    private function createProduct(array $validated, Request $request): Product
    {
        $product = new Product();
        $product->store_id = $validated['store_id'];
        $product->product_name = $validated['product_name'];
        if ($request->hasFile('image')) {
            $imageName = ImageHelper::storeImage($request->file('image'), 'images/products');
            $product->image = $imageName;
        }
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock_quantity = $validated['stock_quantity'];
        $product->category_id = $validated['category_id'];
        $product->status = 1;
        $product->save();

        return $product;
    }

    private function handleProductImages(array $productImages, int $productId): void
    {
        foreach ($productImages as $key => $value) {
            $product_gallery = new ProductGallery();
            $product_gallery->product_id = $productId;
            $imageName = ImageHelper::storeImage($value, 'images/products', "image-gallery-$key-");
            $product_gallery->product_image = $imageName;
            $product_gallery->save();
        }
    }

    private function handleVariantImages(array $colorVariants, int $productId): void
    {
        foreach ($colorVariants as $key => $value) {
            if (isset($value['variant_image']) && isset($value['color'])) {
                $product_variant_image = new ProductVariantImage();
                $product_variant_image->product_id = $productId;
                $product_variant_image->color_id = $value['color'];
                $imageName = ImageHelper::storeImage($value['variant_image'], 'images/products', "image-variant-$key-");
                $product_variant_image->variant_image = $imageName;
                $product_variant_image->save();
            }
        }
    }

    private function handleProductAttributes(array $productAttributes, int $productId): void
    {
        foreach ($productAttributes as $value) {
            if ($value['color'] && $value['size'] && $value['quantity']) {
                $product_attribute = new ProductAttribute();
                $product_attribute->product_id = $productId;
                $product_attribute->color_id = $value['color'];
                $product_attribute->size_id = $value['size'];
                $product_attribute->quantity = $value['quantity'];
                $product_attribute->save();
            }
        }
    }
}
