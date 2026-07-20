<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $website
 * @property string|null $logo
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $country
 * @property string|null $description
 * @property string $schedule_type
 * @property string|null $industry
 * @property string $size
 * @property int $founded
 * @property string $type
 * @property string $revenue
 * @property string $ownership
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jobs> $jobs
 * @property-read int|null $jobs_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereOwnership($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereScheduleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Companies whereZip($value)
 * @mixin \Eloquent
 */
class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'schedule_type',
        'industry',
        'description',
        'size',
        'founded',
        'type',
        'revenue',
        'ownership',
    ];

    /**
     * Get the user that owns the company
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs for the company
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Jobs::class);
    }
}
