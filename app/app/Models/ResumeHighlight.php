<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeHighlight extends Model
{
    protected $fillable = [
        'resume_id',
        'title',
        'description',
        'order',
    ];

    /**
     * Get the resume that owns the highlight.
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
