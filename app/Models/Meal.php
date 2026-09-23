<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'discount_price', 'is_on_sale', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getActivePriceAttribute()
    {
        return ($this->is_on_sale && $this->discount_price) ? $this->discount_price : $this->price;
    }
}