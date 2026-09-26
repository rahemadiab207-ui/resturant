<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPreference extends Model
{
    protected $fillable = [
        'user_id',
        'preferred_categories',
        'preferred_ingredients',
        'excluded_ingredients',
        'preferred_spicy_level',
        'minimum_calories',
        'maximum_calories',
        'minimum_budget',
        'maximum_budget',
        'preferences_text',
    ];

    protected $casts = [
        'preferred_spicy_level' => 'integer',
        'minimum_calories' => 'integer',
        'maximum_calories' => 'integer',
        'minimum_budget' => 'decimal:2',
        'maximum_budget' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}




