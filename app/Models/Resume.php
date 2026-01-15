<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $resume_template_id
 * @property string $title
 * @property string $slug
 * @property array<array-key, mixed>|null $data
 * @property int $completeness_score
 * @property bool $is_public
 * @property string $share_token
 * @property \Illuminate\Support\Carbon|null $share_expires_at
 * @property \Illuminate\Support\Carbon|null $last_exported_at
 * @property string|null $pdf_path
 * @property bool $watermark_enabled
 * @property string $status
 * @property string $language
 * @property int|null $duplicated_from_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ResumeTemplate|null $template
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereCompletenessScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereDuplicatedFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereLastExportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume wherePdfPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereResumeTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereShareExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereShareToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Resume whereWatermarkEnabled($value)
 * @mixin \Eloquent
 */
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
