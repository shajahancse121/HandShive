<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['customer_id','blog_id','details'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
