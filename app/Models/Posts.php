<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string $content
 * @property string|null $image
 * @property string|null $video
 * @property string|null $audio
 * @property string|null $document
 * @property string $visibility
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostsComments> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostsLikes> $likes
 * @property-read int|null $likes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posts whereVisibility($value)
 * @mixin \Eloquent
 */
class Posts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'video',
        'audio',
        'document',
        'visibility',
        'type',
    ];

    /**
     * Get post likes
     */
    public function likes(): HasMany
    {
        return $this->hasMany(PostsLikes::class, 'post_id');
    }

    /**
     * Get post comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(PostsComments::class, 'post_id');
    }
}
