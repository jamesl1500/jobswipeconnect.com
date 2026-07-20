<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $job_seeker_id
 * @property int $job_poster_id
 * @property int $job_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereJobPosterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereJobSeekerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Matches whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'job_poster_id',
        'status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

    public function jobPoster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_poster_id');
    }
}
