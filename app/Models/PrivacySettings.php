<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $show_email
 * @property int $show_phone
 * @property int $show_location
 * @property int $show_resume
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereShowEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereShowLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereShowPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereShowResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacySettings whereUserId($value)
 * @mixin \Eloquent
 */
class PrivacySettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'show_email',
        'show_phone',
        'show_location',
        'show_resume',
    ];

    /**
     * Get the user that owns the privacy settings
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
