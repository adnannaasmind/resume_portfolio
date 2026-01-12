<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'preview_url',
        'cover_image',
        'description',
        'is_premium',
        'metadata',
        'demo_pdf_path',
        'category',
        'locale',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'metadata' => 'array',
    ];

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }
}
