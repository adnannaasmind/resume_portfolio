<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $headline
 * @property string|null $phone
 * @property string|null $company
 * @property string|null $website
 * @property string|null $location
 * @property string|null $summary
 * @property array<array-key, mixed>|null $social_links
 * @property array<array-key, mixed>|null $skills
 * @property array<array-key, mixed>|null $experiences
 * @property array<array-key, mixed>|null $educations
 * @property array<array-key, mixed>|null $certifications
 * @property string $availability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCertifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereEducations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereExperiences($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereWebsite($value)
 *
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'headline',
        'phone',
        'company',
        'website',
        'location',
        'summary',
        'social_links',
        'skills',
        'experiences',
        'educations',
        'certifications',
        'availability',
    ];

    protected $casts = [
        'social_links' => 'array',
        'skills' => 'array',
        'experiences' => 'array',
        'educations' => 'array',
        'certifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
