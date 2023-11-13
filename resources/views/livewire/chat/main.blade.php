<div class="chat-container flex flex-row">
    @livewire('chat.chat-create')

    <div class="right-side flex flex-col flex-grow justify-between">
        @livewire('chat.chat-list')
        @livewire('chat.send-message')
    </div>

</div>
