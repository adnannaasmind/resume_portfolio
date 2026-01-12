<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
