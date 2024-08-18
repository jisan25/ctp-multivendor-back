<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\MethodHelper;
use App\Models\Customer\Customer;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerOwnerShip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $routeName): Response
    {
        $customer = MethodHelper::getCustomer();
        $customerData = null;

        switch ($routeName) {
            case 'order':
                $customerData = $customer->orders;
                break;

            case 'order_detail':
                $customerData = Customer::getOrderDetails($customer->id);
                break;

            case 'review':
                $customerData = $customer->reviews;
                break;
            case 'question':
                $customerData = $customer->questions;
                break;

            default:
                abort(500, 'Unsupported route name');
                break;
        }

        return MethodHelper::checkOwnerShip($request->route($routeName), $customerData, $next, $request);
    }
}
