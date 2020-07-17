<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

   protected $fillable = [
       'blog_category_id',
       'title',
       'details',
       'photo',
       'tag',
       'status',
       'publish_date',
       'popular_blog'
   ];

   public function blog_category()
   {
       return $this->belongsTo(BlogCategory::class);
   }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
