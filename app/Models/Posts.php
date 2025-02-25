<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**'
     * Get post likes
     */
    public function likes()
    {
        return $this->hasMany(PostsLikes::class, 'post_id');
    }

    /**
     * Get post comments
     */
    public function comments()
    {
        return $this->hasMany(PostsComments::class, 'post_id');
    }
}
