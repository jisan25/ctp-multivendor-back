<?php

namespace App\Models\Vendor;

use App\Models\Product\Order;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // protected $hidden = [
    //     'status'
    // ];

    protected $fillable = [
        'vendor_id',
        'store_name',
        'store_description',
        'store_logo',
        'store_address',
        'store_phone',
        'status'
    ];
}
