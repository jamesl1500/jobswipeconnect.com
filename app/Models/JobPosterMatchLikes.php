<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $job_poster_id
 * @property int $job_id
 * @property int $job_seeker_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereJobPosterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereJobSeekerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosterMatchLikes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobPosterMatchLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_poster_id',
        'job_seeker_id',
        'type',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    public function jobPoster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_poster_id');
    }

    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}
