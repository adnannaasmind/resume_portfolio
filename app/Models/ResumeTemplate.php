<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $preview_url
 * @property string|null $cover_image
 * @property string|null $description
 * @property bool $is_premium
 * @property array<array-key, mixed>|null $metadata
 * @property string|null $demo_pdf_path
 * @property string|null $category
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Resume> $resumes
 * @property-read int|null $resumes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereDemoPdfPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereIsPremium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate wherePreviewUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResumeTemplate whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ResumeTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'blade_file',
        'preview_url',
        'preview_image',
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
