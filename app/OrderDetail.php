<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable =[
        'order_id',
        'product_id',
        'qty','weight',
        'unit_id',
        'sales_rate',
        'discount_amount',
        'order_date',
        'order_status',
        'order_type'
    ];

}
