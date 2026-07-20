<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property string $comment
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostsComments whereUserId($value)
 * @mixin \Eloquent
 */
class PostsComments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];
}
