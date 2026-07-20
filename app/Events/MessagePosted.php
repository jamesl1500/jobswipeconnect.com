<?php

namespace App\Events;

use App\Libraries\Conversation;
use App\Models\Conversation_messages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Conversation $conversation;

    public function __construct(public Conversation_messages $message)
    {
        $this->conversation = new Conversation();
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel|array
    {
        $uid = $this->conversation->GetConversationUniqueId($this->message->conversation_uid);

        return new PrivateChannel('conversation.' . $uid);
    }
}
