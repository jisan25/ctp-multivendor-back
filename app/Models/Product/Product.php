<?php

namespace App\Models\Product;

use App\Models\Vendor\Store;
use App\Models\Vendor\Vendor;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function customers()
    {
        return $this->hasManyThrough(Customer::class, Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }

    protected $fillable = [
        'store_id',
        'product_name',
        'image',
        'description',
        'price',
        'stock_quantity',
        'category_id',
        'status'
    ];
}
