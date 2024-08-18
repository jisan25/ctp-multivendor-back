<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status'
    ];
}
