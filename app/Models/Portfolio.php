<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
