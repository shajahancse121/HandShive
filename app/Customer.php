<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable= ['name','email','phone','password','address','code','verified','verified_email','email_code'];

    public function setEmailAttribute($value) {
        if ( empty($value) ) { // will check for empty string, null values, see php.net about it
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }
    public function setPhoneAttribute($value) {
        if ( empty($value) ) { // will check for empty string, null values, see php.net about it
            $this->attributes['phone'] = NULL;
        } else {
            $this->attributes['phone'] = $value;
        }
    }
}
