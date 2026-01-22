<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumePassion extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'title',
        'description',
        'icon',
        'display_order',
    ];

    /**
     * Get the resume that owns the passion
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
