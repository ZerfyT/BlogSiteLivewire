<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class SendMessage extends Component
{
    public $messageText;
    public $conversationId;

    #[On('conversationChecked')]
    public function getConversation($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    public function saveMessage()
    {
        $conversation = Conversation::find($this->conversationId);
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $conversation->receiver_id,
            'message' => $this->messageText,
        ]);
        $conversation->last_time_message = $message->created_at;
        $conversation->save();

        $this->dispatch('updateMessages', $this->conversationId, $message->id);
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
