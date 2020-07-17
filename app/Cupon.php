<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
   protected $fillable = ['code','start_date','end_date','discount_type','amount','status'];
   public function orders()
   {
       return $this->hasMany(Order::class);
   }
}
