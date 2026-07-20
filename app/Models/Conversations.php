<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $conversation_uid
 * @property string $conversation_name
 * @property string $conversation_description
 * @property int $conversation_sender
 * @property int $conversation_receiver
 * @property int $job_id
 * @property string $status
 * @property string|null $applicant_notes
 * @property string|null $job_poster_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conversation_members> $members
 * @property-read int|null $members_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conversation_messages> $messages
 * @property-read int|null $messages_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereApplicantNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereConversationDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereConversationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereConversationReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereConversationSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereConversationUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereJobPosterNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Conversations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Conversations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'conversation_uid',
        'conversation_sender',
        'conversation_receiver',
        'conversation_name',
        'conversation_description',
        'job_id',
        'status',
        'applicant_notes',
        'job_poster_notes',
    ];

    /**
     * Get the messages that belong to the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Conversation_messages::class, 'conversation_uid');
    }

    /**
     * Get the members that belong to the conversation.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Conversation_members::class, 'conversation_uid');
    }
}
