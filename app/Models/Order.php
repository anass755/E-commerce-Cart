<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      
        'user_id',
        'guest_email',
        'total_amount',
        'status',
        'address_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function address()
    {
    return $this->belongsTo(Address::class);
    }

}
