<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'meal_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}