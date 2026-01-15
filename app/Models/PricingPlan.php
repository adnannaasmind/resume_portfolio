<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property numeric $price
 * @property string $currency
 * @property string $interval
 * @property bool $is_featured
 * @property bool $is_active
 * @property int $resume_limit
 * @property int $portfolio_limit
 * @property int $template_limit
 * @property int $ai_credits
 * @property array<array-key, mixed>|null $features
 * @property string|null $stripe_price_id
 * @property string|null $paypal_plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereAiCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePaypalPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePortfolioLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereResumeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereStripePriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereTemplateLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PricingPlan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'currency',
        'interval',
        'is_active',
        'is_featured',
        'resume_limit',
        'portfolio_limit',
        'template_limit',
        'ai_credits',
        'features',
        'stripe_price_id',
        'paypal_plan_id',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
