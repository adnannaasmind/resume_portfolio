<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resume_template_id',
        'title',
        'slug',
        'data',
        'completeness_score',
        'is_public',
        'share_token',
        'share_expires_at',
        'last_exported_at',
        'pdf_path',
        'watermark_enabled',
        'status',
        'language',
        'duplicated_from_id',
    ];

    protected $casts = [
        'data' => 'array',
        'is_public' => 'boolean',
        'watermark_enabled' => 'boolean',
        'share_expires_at' => 'datetime',
        'last_exported_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $resume) {
            if (!$resume->slug) {
                $resume->slug = Str::slug($resume->title.'-'.Str::random(6));
            }

            if (!$resume->share_token) {
                $resume->share_token = Str::uuid()->toString();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(ResumeTemplate::class, 'resume_template_id');
    }

    public function duplicate(): self
    {
        $copy = $this->replicate([
            'slug',
            'share_token',
            'pdf_path',
            'last_exported_at',
        ]);

        $copy->title = $this->title.' Copy';
        $copy->slug = Str::slug($copy->title.'-'.Str::random(5));
        $copy->share_token = Str::uuid()->toString();
        $copy->status = 'draft';
        $copy->duplicated_from_id = $this->id;
        $copy->save();

        return $copy;
    }
}
