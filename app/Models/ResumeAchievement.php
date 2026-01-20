<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'title',
        'description',
        'date',
        'issuer',
        'display_order',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the resume that owns the achievement
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
