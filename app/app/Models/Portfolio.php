<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string|null $headline
 * @property string|null $hero_image
 * @property string|null $summary
 * @property array<array-key, mixed>|null $content
 * @property array<array-key, mixed>|null $projects
 * @property array<array-key, mixed>|null $testimonials
 * @property array<array-key, mixed>|null $cta
 * @property array<array-key, mixed>|null $social_links
 * @property string $template
 * @property string $language
 * @property array<array-key, mixed>|null $theme
 * @property bool $is_public
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int $views_count
 * @property int $downloads_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereCta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereDownloadsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereHeroImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereTestimonials($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Portfolio whereViewsCount($value)
 *
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'headline',
        'hero_image',
        'summary',
        'content',
        'projects',
        'testimonials',
        'cta',
        'social_links',
        'template',
        'language',
        'theme',
        'is_public',
        'published_at',
        'views_count',
        'downloads_count',
    ];

    protected $casts = [
        'content' => 'array',
        'projects' => 'array',
        'testimonials' => 'array',
        'cta' => 'array',
        'social_links' => 'array',
        'theme' => 'array',
        'is_public' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
