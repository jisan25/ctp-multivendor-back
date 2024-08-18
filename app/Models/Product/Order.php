<?php

namespace App\Models\Product;

use App\Models\Vendor\Store;
use App\Models\Customer\Customer;
use App\Models\Product\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'order_id');
    }

    protected $fillable = [
        'order_id',
        'customer_id',
        'total_amount',
        'type',
        'status',
        'store_id'
    ];
}
