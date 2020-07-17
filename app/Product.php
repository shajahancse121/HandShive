<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Product extends Model
{
    use Sluggable;
    protected $fillable = [
      'category_id',
      'sub_category_id',
      'name',
      'price',
      'discount_type',
      'discount',
      'stock',
      'new_product',
      'popular_product',
      'best_seller',
      'short_description',
      'long_description',
      'status',
      'unit_id',
      'weight'

  ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=>true
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function product_images(){

        return $this->hasMany(ProductImage::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
