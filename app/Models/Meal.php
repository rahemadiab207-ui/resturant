<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'is_on_sale',
        'category_id',
        'image',
        'ingredients',
        'calories',
        'spicy_level',
        'rating',
        'is_available',

        // Food properties
        'is_spicy',
        'has_cheese',
        'has_chicken',
        'has_meat',
        'has_mushroom',
        'is_vegetarian',
        'is_healthy',
        'is_vegan',
        'is_gluten_free',
        'is_dairy_free',
        'is_high_protein',
        'is_low_calorie',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',

        'is_on_sale' => 'boolean',
        'is_available' => 'boolean',

        'calories' => 'integer',
        'spicy_level' => 'integer',
        'rating' => 'decimal:2',

        'is_spicy' => 'boolean',
        'has_cheese' => 'boolean',
        'has_chicken' => 'boolean',
        'has_meat' => 'boolean',
        'has_mushroom' => 'boolean',
        'is_vegetarian' => 'boolean',
        'is_healthy' => 'boolean',
        'is_vegan' => 'boolean',
        'is_gluten_free' => 'boolean',
        'is_dairy_free' => 'boolean',
        'is_high_protein' => 'boolean',
        'is_low_calorie' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getActivePriceAttribute()
    {
        if (
            $this->is_on_sale &&
            $this->discount_price !== null &&
            $this->discount_price > 0 &&
            $this->discount_price < $this->price
        ) {
            return $this->discount_price;
        }

        return $this->price;
    }

    public function getHasDiscountAttribute()
    {
        return $this->is_on_sale &&
            $this->discount_price !== null &&
            $this->discount_price > 0 &&
            $this->discount_price < $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->has_discount || $this->price <= 0) {
            return 0;
        }

        return round(
            (($this->price - $this->discount_price) / $this->price) * 100
        );
    }


   
     
public function favorites()
{
return $this->hasMany(Favorite::class);
}

public function recommendations()
{
return $this->hasMany(Recommendation::class);
}

}