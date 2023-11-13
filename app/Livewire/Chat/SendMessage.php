<?php

namespace App\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
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
        $breeds = Http::get('https://dog.ceo/api/breeds/list/random/5')['message'];
        dd($breeds);
        $conversation = Conversation::find($this->conversationId);
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $conversation->receiver_id,
            'message' => $this->messageText,
        ]);
        $conversation->last_time_message = $message->created_at;
        $conversation->save();

        // dd($message->sender);

        $this->dispatch('updateMessages', $this->conversationId, $message->id);
        event(new MessageSent($message->sender, $message->receiver, $message, $conversation));
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
