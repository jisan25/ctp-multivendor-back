<?php

namespace App\Helpers;

use App\Models\Vendor\Store;
use App\Models\Product\Order;
use App\Models\Vendor\Vendor;
use App\Models\Product\Product;
use App\Models\Customer\Customer;
use App\Models\Product\DeliveryType;
use Illuminate\Support\Facades\Auth;

class MethodHelper
{

    public static function getVendor()
    {
        return Vendor::findOrFail(Auth::id());
    }
    public static function getCustomer()
    {
        return Customer::findOrFail(Auth::id());
    }
    public static function getCustomerOrderIds()
    {
        return Order::where('customer_id', Auth::id())->pluck('order_id');
    }
    public static function getVendorStoreIds()
    {
        return Store::where('vendor_id', Auth::id())->pluck('id');
    }
    public static function getVendorOrderIds()
    {
        return  Order::whereIn('store_id', MethodHelper::getVendorStoreIds())
            ->pluck('order_id');
    }
    public static function getVendorProductIds()
    {
        return Product::whereIn('store_id', MethodHelper::getVendorStoreIds())->pluck('id');
    }

    public static function checkOwnerShip($object, $array, $next, $request, $type)
    {
        if ($object) {
            $object_id = null;
            $order_id = null;
            if ($type == 'order_id') {
                $order_id = $object;
            } else {
                $object_id = is_object($object) ? $object->id : $object['id'];
            }

            $exists = false;

            foreach ($array as $item) {
                if ($item->id == $object_id || (isset($item->order_id) && $item->order_id == $order_id)) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        return $next($request);
    }



    public static function generateOrderId()
    {
        // Check if the orders table is empty
        $lastOrder = Order::latest('id')->first();

        if (!$lastOrder) {
            // Orders table is empty, generate an order ID based on the current date
            $year = date('Y');
            $month = date('m'); // Month with leading zeros
            $day = date('d'); // Day with leading zeros

            $orderId = $year . $month . $day . '1'; // Start with 1
        } else {
            // Orders table is not empty, increment the last order ID by 1
            $orderId = $lastOrder->order_id + 1;
        }

        return $orderId;
    }
    public static function GetDeliveryFee($id)
    {
        return DeliveryType::findOrFail($id)->amount;
    }
}
