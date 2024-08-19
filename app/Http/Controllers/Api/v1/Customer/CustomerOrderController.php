<?php

namespace App\Http\Controllers\Api\v1\Customer;

use App\Helpers\MethodHelper;
use App\Models\Product\Order;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Product\OrderRequest;
use App\Http\Requests\Vendor\VendorFilterRequest;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFilterRequest $request)
    {


        $query = Order::where('customer_id', Auth::id());


        $search_columns = ["order_id"];

        $this->applyFilterSortSearch($search_columns, $query, $request);

        $orders = $query->with('store', 'orderDetails.product')->paginate(10);

        return $this->successResponse('Data Retrieved Successfully', ['customer_orders' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $customerId = Auth::id();
            $orders = [];
            $storeOrderMap = [];

            // Group cart items by store ID
            foreach ($request->cartitems as $item) {
                $product = Product::findOrFail($item['product_id']);
                $storeOrderMap[$product->store_id][] = $item;
            }

            // Create orders for each store
            foreach ($storeOrderMap as $storeId => $cartItems) {
                $orderId = MethodHelper::generateOrderId();

                $totalAmount = 0;

                // Calculate total amount for the order
                foreach ($cartItems as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $productPrice = $product->price;
                    $productDeliveryFee = MethodHelper::GetDeliveryFee($item['delivery_type_id']);
                    $totalAmount += ($productPrice * $item['quantity']) + $productDeliveryFee;
                }

                // Create order
                $order = Order::create([
                    'order_id' => $orderId,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmount,
                    'type' => 'Online',
                    'status' => 'Order Placed',
                    'store_id' => $storeId,
                ]);

                // Create order details
                foreach ($cartItems as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $productPrice = $product->price;
                    $productDeliveryFee = MethodHelper::GetDeliveryFee($item['delivery_type_id']);

                    OrderDetails::create([
                        'order_id' => $order->order_id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $productPrice,
                        'delivery_fee' => $productDeliveryFee,
                    ]);
                }

                $orders[] = $order;
            }

            DB::commit();

            return $this->successResponse('Order Created Successfully', ['orders' => $orders]);
        } catch (QueryException $e) {
            DB::rollBack();
            return $this->errorResponse('An error occurred while creating order.', $e);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $data = $order->load('store');
        return $this->successResponse('Data Retrieved Successfully', ['order' => $data]);
    }

    public function update(Order $order)
    {
        if ($order->status == 'Order Placed') {
            $order->update([
                'status' => 'Cancelled'
            ]);
            return $this->successResponse('Order Cancelled Successfully', ['order' => 'cancelled']);
        } else {
            return $this->errorResponse('You are not eligible.', null, 403);
        }
    }
}
