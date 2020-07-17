<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blling;

class Order extends Model
{
    //
    protected $fillable = [
        'invoice_no',
        'cupon_id',
        'cupon_amount',
        'shipping_id',
        'shipping_title',
        'shipping_amount',
        'total_amount',
        'total_discount_product',
        'total_paid_amount',
        'order_date',
        'delivery_date',
        'order_type',
        'blling_id',
        'customer_id',
        'other_shipping_id',
        'order_status',
        'payment_type_id',
        'courier_id'

    ];

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function cupon()
    {
        return $this->belongsTo(Cupon::class);
    }

    public function blling()
    {
        return $this->belongsTo(Blling::class);
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }
    public function other_shipping()
    {
        return $this->belongsTo(OtherShipping::class);
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

}
