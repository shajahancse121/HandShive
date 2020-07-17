<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title','description','photo','url_link','status','department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
