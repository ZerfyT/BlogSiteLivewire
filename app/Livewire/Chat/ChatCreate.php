<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatCreate extends Component
{
    // public $users;
    public $message;

    public function checkConversation($user_id) {
        $conversation = Conversation::where('receiver_id', auth()->user()->id)
        ->where('sender_id', $user_id)
        ->orWhere('receiver_id', $user_id)
        ->where('sender_id', auth()->user()->id)
        ->get()->first();

        if($conversation !== null) {
            // dd($conversation);
            $this->dispatch('conversationChecked', $conversation->id);
        } else {
            $createdConversation = Conversation::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $user_id,
            ]);

            $createdMessage = Message::create([
                'conversation_id' => $createdConversation->id,
                'sender_id' => auth()->user()->id,
                'receiver_id' => $user_id,
                'message' => 'Welcome to the chat',
            ]);

            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();
            $this->dispatch('conversationChecked', $createdConversation->id);
            // dd($createdConversation, $createdMessage);
        }

    }
    public function render()
    {
        return view('livewire.chat.chat-create', [
            'users' => User::all()->except(auth()->user()->id),
        ]);
    }
}
