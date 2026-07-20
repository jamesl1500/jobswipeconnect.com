<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $profile_id
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileViews whereUserId($value)
 * @mixin \Eloquent
 */
class ProfileViews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'profile_id',
    ];
}
