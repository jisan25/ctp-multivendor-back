<?php

namespace App\Models\Product;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'delivery_fee'
    ];
}
