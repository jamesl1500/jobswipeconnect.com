<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $conversation_member_uid
 * @property int $conversation_uid
 * @property int $user_uid
 * @property string $type
 * @property string $user_role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversations|null $conversation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereConversationMemberUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereConversationUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereUserRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_members whereUserUid($value)
 * @mixin \Eloquent
 */
class Conversation_members extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conversation_member_uid',
        'conversation_uid',
        'type',
        'user_uid',
        'user_role',
    ];

    /**
     * Get the conversation that belong to the member.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversations::class, 'conversation_uid');
    }

    /**
     * Get the user that belong to the member.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uid');
    }
}
