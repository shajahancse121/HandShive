<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskWeDo extends Model
{
    protected $fillable = ['tag_url','icon','status','department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
