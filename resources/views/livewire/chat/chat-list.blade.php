<div class="chat-messages flex-grow">

    @if (isset($messages))
        @foreach ($messages as $message)
            <div class="chat-message">
                <span class="chat-message-sender @if ($message->senderIsAuth()) text-red-600 @endif">
                    {{ $message->sender->name }}</span>
                <span class="chat-message-content">{{ $message->message }}
                    </span>
            </div>
        @endforeach
    @endif



</div>
