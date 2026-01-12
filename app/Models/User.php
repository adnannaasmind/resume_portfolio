<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'preferred_locale',
        'timezone',
        'avatar_url',
        'profile_completed',
        'last_login_at',
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
            'profile_completed' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function aiRequests()
    {
        return $this->hasMany(AIRequest::class);
    }

    public function activeSubscription()
    {
        return $this->subscriptions()
            ->whereIn('status', ['active', 'trialing'])
            ->latest('renews_at')
            ->first();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
