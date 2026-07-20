<?php

namespace App\Broadcasting;

use App\Libraries\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ConversationChannel
{
    public function __construct(public string $conversation_uid)
    {
        Log::info("New user joined conversation with UID: {$this->conversation_uid}");
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): bool
    {
        $conversation = new Conversation();

        return $conversation->CheckIfUserIsConversationMember($this->conversation_uid, $user->id) !== null;
    }
}
