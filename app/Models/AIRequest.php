<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $prompt
 * @property array<array-key, mixed>|null $response
 * @property int $tokens_used
 * @property numeric $cost
 * @property string $provider
 * @property array<array-key, mixed>|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest wherePrompt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereTokensUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AIRequest whereUserId($value)
 *
 * @mixin \Eloquent
 */
class AIRequest extends Model
{
    use HasFactory;

    protected $table = 'ai_requests';

    protected $fillable = [
        'user_id',
        'type',
        'prompt',
        'response',
        'tokens_used',
        'cost',
        'provider',
        'metadata',
    ];

    protected $casts = [
        'response' => 'array',
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
