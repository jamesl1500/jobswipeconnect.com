<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $conversation_message_uid
 * @property int $conversation_uid
 * @property int $user_uid
 * @property string $conversation_message_content
 * @property string $conversation_message_type
 * @property string $status
 * @property string|null $attachment
 * @property string|null $attachment_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversations|null $conversation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereAttachmentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereConversationMessageContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereConversationMessageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereConversationMessageUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereConversationUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversation_messages whereUserUid($value)
 * @mixin \Eloquent
 */
class Conversation_messages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conversation_message_uid',
        'conversation_uid',
        'user_uid',
        'conversation_message_content',
        'conversation_message_type',
        'status',
        'attachment',
        'attachment_type',
    ];

    /**
     * Get the conversation that owns the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversations::class, 'conversation_uid');
    }

    /**
     * Get the user that owns the message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uid');
    }
}
