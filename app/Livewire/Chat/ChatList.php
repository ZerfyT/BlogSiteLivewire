<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatList extends Component
{

    public $authId;
    public $connversation;
    public $messages;

    public function mount()
    {
        $this->authId = auth()->id();
        // $this->connversations = Conversation::where('sender_id', $this->authId)
        //     ->orWhere('receiver_id', $this->authId)
        //     ->orderBy('last_time_message', 'desc')
        //     ->get();
    }

    #[On('conversationChecked')]
    public function getConversation($conversationId)
    {
        $this->connversation = Conversation::where('id', $conversationId)->get();
        $this->messages = Message::where('conversation_id', $conversationId)->get();
        // dd($this->messages);
    }

    #[On('updateMessages')]
    public function updateMessages($conversationId, $messageId)
    {
        $newMessage = Message::where('id', $messageId)->get()->first();
        $this->messages->push($newMessage);
    }

    public function render()
    {
        return view('livewire.chat.chat-list', [
        ]);
    }
}