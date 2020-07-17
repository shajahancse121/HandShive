<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    use Sluggable;

    protected $fillable = ['name','status','department_id','category_image'];



    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=>true
            ]
        ];
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
