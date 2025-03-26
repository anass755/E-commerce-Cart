<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Product extends Model
{
    protected $fillable=[
        'category_id',
        'sub_category',
        'name',
        'code',
        'short_description',
        'specification',
        'rate',
        'photo'
       ];

       public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // A product belongs to a subcategory (optional)
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_category');
    }
      
    
}
