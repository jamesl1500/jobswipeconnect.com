<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsLikes whereUserId($value)
 * @mixin \Eloquent
 */
class PostsLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
