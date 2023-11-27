<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if($search) Searching {{$search}} @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button wire:click="setSort('desc')" class="py-4 {{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500'  }}">Latest</button>
            <button wire:click="setSort('asc')" class="py-4 {{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500'  }}">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $postItem)
            <x-posts.post-item :post="$postItem" />
        @endforeach
    </div>

    {{-- Pagination Links --}}
    <div class="my-3">
        {{ $this->posts->onEachSide(2)->links() }}
    </div>
</div>
