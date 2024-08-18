<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Color;

class ProductAttribute extends Model
{
    use HasFactory;

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'quantity'
    ];
}
