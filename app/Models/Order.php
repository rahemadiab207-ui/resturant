<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'address',
        'phone',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    public static function statuses(): array
    {
        return [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'preparing' => 'Preparing',
            'ready' => 'Ready',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status]
            ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {

            'pending' => '#f59e0b',

            'confirmed' => '#2563eb',

            'preparing' => '#8b5cf6',

            'ready' => '#16a34a',

            'out_for_delivery' => '#0891b2',

            'delivered' => '#15803d',

            'cancelled' => '#dc2626',

            default => '#6b7280',
        };
    }
}