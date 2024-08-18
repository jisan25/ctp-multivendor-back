<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'parent_category_id', 'type'];

    // Define the relationship for subcategories
    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->where('type', 'sub_category');
    }

    // Define the relationship for child categories
    public function child_categories()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->where('type', 'child_category');
    }

    // Define the relationship for the parent category
    public function parent_category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Recursive relationship to get all descendants
    public function descendants()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->with('descendants');
    }
}
