<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'user_id',
        'meal_id',
        'beverage_id',
        'match_percentage',
        'reason',
        'source',
    ];

    protected $casts = [
        'match_percentage' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function beverage()
    {
        return $this->belongsTo(Beverage::class);
    }
}