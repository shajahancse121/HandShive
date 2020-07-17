<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{

    protected $fillable = ['support_tag','status','department_id','support_message'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
