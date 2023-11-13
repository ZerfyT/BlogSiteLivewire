<div class="left-side chat-users-container">
    @foreach ($users as $user)
        <div wire:click="checkConversation({{ $user->id }})" class="user-list-item">{{ $user->name }}</div>
    @endforeach
</div>
