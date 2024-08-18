<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\MethodHelper;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureVendorOwnerShip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $routeName, $type = null): Response
    {
        $vendor = MethodHelper::getVendor();
        $vendorData = null;

        switch ($routeName) {
            case 'my_product':
                $vendorData = $vendor->products;
                break;
            case 'my_store':
                $vendorData = $vendor->stores;
                break;
            case 'my_order':
                $vendorData = $vendor->orders;
                break;
            case 'my_order_detail':
                $vendorData = Vendor::getVendorOrderDetails(Auth::id());
                break;
            case 'my_review':
                $vendorData = Vendor::getVendorReviews(Auth::id());
                break;
            case 'my_customer':
                $vendorData = Vendor::getCustomersForVendor(Auth::id());
                break;
            case 'my_payment':
                $vendorData = Vendor::getVendorPayments(Auth::id());
                break;
            case 'my_question':
                $vendorData = Vendor::getVendorQuestions(Auth::id());
                break;
            default:
                abort(500, 'Unsupported route name');
                break;
        }

        return MethodHelper::checkOwnerShip($request->route($routeName), $vendorData, $next, $request, $type);
    }
}
