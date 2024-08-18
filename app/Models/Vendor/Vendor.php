<?php

namespace App\Models\Vendor;

use App\Models\Product\Order;
use App\Models\Product\Review;
use App\Models\Product\Product;
use App\Models\Customer\Customer;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\Product\OrderDetails;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;



    public function products()
    {
        return $this->hasManyThrough(Product::class, Store::class);
    }

    public static function getCustomersForVendor($vendorId)
    {
        return Customer::select([
            'customers.id',
            'customers.full_name',
            'customers.email',
            'customers.phone',
            'customers.address',
            'customers.created_at',
            'customers.updated_at',
            'divisions.name as division_name',
            'districts.name as district_name',
            'upazilas.name as upazila_name'
        ])
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->join('divisions', 'customers.division_id', '=', 'divisions.id')
            ->join('districts', 'customers.district_id', '=', 'districts.id')
            ->join('upazilas', 'customers.upazila_id', '=', 'upazilas.id')
            ->where('stores.vendor_id', $vendorId)
            ->distinct();
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Store::class);
    }

    public static function getVendorReviews($vendorId)
    {
        // Use raw SQL query to retrieve reviews for the vendor
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->where('stores.vendor_id', $vendorId)
            ->select('reviews.*')
            ->get();

        return $reviews;
    }

    public static function getVendorQuestions($vendorId)
    {
        $questions = DB::table('questions')
            ->join('products', 'questions.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->where('stores.vendor_id', $vendorId)
            ->select('questions.*')
            ->get();

        return $questions;
    }

    public static function getVendorOrderDetails($vendorId)
    {
        $orderDetails = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
            ->join('stores', 'orders.store_id', '=', 'stores.id')
            ->join('vendors', 'stores.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', $vendorId)
            ->select('order_details.*')
            ->get();

        return $orderDetails;
    }

    public static function getVendorPayments($vendorId)
    {
        $query = "
            SELECT payments.*
            FROM payments
            JOIN orders ON payments.order_id = orders.order_id
            JOIN stores ON orders.store_id = stores.id
            WHERE stores.vendor_id = ?
        ";
        $payments = DB::select($query, [$vendorId]);

        return $payments;
    }


    public function stores()
    {
        return $this->hasMany(Store::class);
    }
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
    ];
}
