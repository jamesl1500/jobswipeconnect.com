<?php

namespace App\Libraries;

use App\Models\Conversation_members;
use App\Models\Conversation_messages;
use App\Models\Conversations;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class Conversation
{
    protected Conversations $conversations_model;
    protected Conversation_members $conversation_members_model;
    protected Conversation_messages $conversation_messages_model;

    public function __construct()
    {
        $this->conversations_model = new Conversations();
        $this->conversation_members_model = new Conversation_members();
        $this->conversation_messages_model = new Conversation_messages();
    }

    /**
     * GetOtherConversationMember
     */
    public function GetOtherConversationMember(int|string $conversation_id, int $user_uid): ?Conversation_members
    {
        return $this->conversation_members_model
            ->where('conversation_uid', $conversation_id)
            ->where('user_uid', '!=', $user_uid)
            ->first();
    }

    /**
     * CheckIfUserIsConversationMember
     *
     * @param string $conversation_uid
     * @param int $user_uid
     */
    public function CheckIfUserIsConversationMember(string $conversation_uid, int $user_uid): ?Conversation_members
    {
        $conversation = $this->conversations_model->where('conversation_uid', $conversation_uid)->first();

        return $this->conversation_members_model
            ->where('conversation_uid', $conversation->id)
            ->where('user_uid', $user_uid)
            ->first();
    }

    /**
     * GetConversationMembers
     *
     * @param string $conversation_uid
     */
    public function GetConversationMembers(string $conversation_uid): Collection
    {
        return $this->conversations_model
            ->where('conversation_uid', $conversation_uid)
            ->first()
            ->members()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * GetConversationMessages
     *
     * @param string $conversation_uid
     */
    public function GetConversationMessages(string $conversation_uid): Collection
    {
        return $this->conversations_model
            ->where('conversation_uid', $conversation_uid)
            ->first()
            ->messages()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * GenerateUid
     * -----------
     * Generate a unique ID for a conversation, messages, and members.
     *
     * @return string
     */
    public function GenerateUid(): string
    {
        return Str::random(35) . time() . Str::random(3);
    }

    /**
     * CheckIfConversationExists
     * -------------------------
     * Check if a conversation exists between two users.
     *
     * @param int $user_uid_1
     * @param int $user_uid_2
     */
    public function CheckIfConversationExists(int $user_uid_1, int $user_uid_2): ?Conversations
    {
        return $this->conversations_model
            ->where('conversation_sender', $user_uid_1)
            ->where('conversation_receiver', $user_uid_2)
            ->orWhere('conversation_sender', $user_uid_2)
            ->where('conversation_receiver', $user_uid_1)
            ->first();
    }

    /**
     * CheckIfConversationExistsByUid
     *
     * @param string $conversation_uid
     */
    public function CheckIfConversationExistsByUid(string $conversation_uid): ?Conversations
    {
        return $this->conversations_model->where('conversation_uid', $conversation_uid)->first();
    }

    /**
     * GetLastMessage
     * --------------
     * Get the last message in a conversation.
     *
     * @param string $conversation_uid
     */
    public function GetLastMessage(string $conversation_uid): ?Conversation_messages
    {
        $conversation = $this->conversations_model->where('id', $conversation_uid)->first();

        return $conversation->messages()->orderBy('created_at', 'desc')->first();
    }

    /**
     * GetConversationUniqueId
     * -----------------------
     * Get the unique ID of a conversation.
     */
    public function GetConversationUniqueId(int|string $conversation_id): string
    {
        $conversation = $this->conversations_model->where('id', $conversation_id)->first();

        return $conversation->conversation_uid;
    }

    /**
     * GetConversationNumericalId
     * ---------------------------
     * Get the numerical ID of a conversation.
     */
    public function GetConversationNumericalId(string $conversation_uid): int
    {
        $conversation = $this->conversations_model->where('conversation_uid', $conversation_uid)->first();

        return $conversation->id;
    }
}
