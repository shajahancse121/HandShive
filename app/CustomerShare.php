<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerShare extends Model
{
    protected $fillable = ['name','message','photo','hyperlink'];

}
