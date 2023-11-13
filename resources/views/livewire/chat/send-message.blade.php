<div class="chat-message-box flex flex-row justify-between items-center">
    <x-input wire:model="messageText" type="text" class="chat-message-box-input w-full" placeholder="Enter your message..."/>
    <x-button wire:click="saveMessage()" class="chat-message-box-button">Send</x-button>
</div>
