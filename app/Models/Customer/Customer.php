<?php

namespace App\Models\Customer;

use App\Models\Product\Order;
use App\Models\Product\Question;
use App\Models\Product\Review;
use App\Models\Shipping;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;




class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }


    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }


    public static function getOrderDetails($customerId)
    {
        $orderDetails = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.customer_id', $customerId)
            ->where('orders.status', '!=', 'Cancelled')
            ->select(
                'order_details.*',
                'orders.total_amount',
                'orders.type as order_type',
                'orders.status as order_status',
                'orders.store_id',
                'products.product_name',
                'products.description as product_description',
                'products.price as product_price',
                'products.stock_quantity as product_stock_quantity',
                'products.image as product_image',
                'stores.store_name',
                'stores.store_description',
                'stores.store_logo',
                'stores.store_address',
                'stores.store_phone',
                'categories.category_name',

            )
            ->get();

        return $orderDetails;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone',
        'division_id',
        'district_id',
        'upazila_id',
        'address',
    ];

    protected $hidden = [
        'password',
    ];
}
