<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Sluggable;

    protected $fillable = ['name','short_description','department_video','status','slug','cover_image','icon'];



    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=>true
            ]
        ];
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
