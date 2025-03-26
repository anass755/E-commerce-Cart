<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'parent_category',
        'name',
        'status'
    ];
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_category');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

   
   
}
