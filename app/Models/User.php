<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone1',
        'phone2',
        'address',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function preferences()
    {
        return $this->hasOne(CustomerPreference::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}