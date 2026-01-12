<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pricing_plan_id',
        'provider',
        'provider_subscription_id',
        'status',
        'renews_at',
        'cancels_at',
        'ended_at',
        'trial_ends_at',
        'metadata',
    ];

    protected $casts = [
        'renews_at' => 'datetime',
        'cancels_at' => 'datetime',
        'ended_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function plan()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
