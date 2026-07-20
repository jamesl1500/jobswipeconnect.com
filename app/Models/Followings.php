<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $following_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings whereFollowingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Followings whereUserId($value)
 * @mixin \Eloquent
 */
class Followings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'following_id',
    ];
}
