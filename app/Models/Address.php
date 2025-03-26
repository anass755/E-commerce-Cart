<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   protected $fillable=[
    'user_id',
    'name',
    'address_line1',
    'address_line2',
    'place',
    'city',
    'district',
    'state',
    'pincode',
    'mobile_no',
    'alternative_mobile',
   ];
  
   
}
