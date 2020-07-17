<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkFlow extends Model
{
    protected $fillable = ['work_flow_img','status','department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
