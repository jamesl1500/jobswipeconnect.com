<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $job_seeker_id
 * @property int $job_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereJobSeekerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSeekerMatchLikes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobSeekerMatchLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'type',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}
