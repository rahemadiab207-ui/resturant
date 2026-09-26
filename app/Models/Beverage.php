<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'is_on_sale',
        'image',
        'calories',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_on_sale' => 'boolean',
        'calories' => 'integer',
        'is_available' => 'boolean',
    ];

    public function getActivePriceAttribute()
    {
        if (
            $this->discount_price !== null &&
            $this->discount_price > 0 &&
            $this->discount_price < $this->price
        ) {
            return $this->discount_price;
        }

        return $this->price;
    }
}