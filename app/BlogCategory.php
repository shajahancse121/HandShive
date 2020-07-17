<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{

    protected $fillable = ['name','status'];


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
