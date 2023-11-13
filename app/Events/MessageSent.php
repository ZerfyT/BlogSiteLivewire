<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $conversation;
    public $receiver;

    /**
     * Create a new event instance.
     */
    public function __construct(User $sender, User $receiver, Message $message, Conversation $conversation)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->conversation = $conversation;
    }

    public function broadcastWith()
    {
        return [
            'message_id' => $this->message->id,
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
            'conversation_id' => $this->conversation->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // dd($this->receiver->id);
        error_log($this->receiver->id);
        error_log($this->sender->id);
        // dd(new Channel('chat.' . $this->receiver->id));
        return [
            new Channel('chat.101'),
        ];
    }
}
