<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600 gap-x-1">

            @if ($this->ActiveCategory || $Search)
                <button class="gray-500 text-xs mr-3" wire:navigate href="{{ route('posts.index') }}">Reset</button>
            @endif

            @if ($this->ActiveCategory)
                <x-badge wire:navigate href="{{ route('posts.index', ['Category' => $this->ActiveCategory]) }}"
                    :TextColor="$this->ActiveCategory->text_color" :BackgroundColor="$this->ActiveCategory->background_color">
                    {{ $this->ActiveCategory->title }}
                </x-badge>
            @endif

            @if ($Search)
                <span class="ml-2">
                    Searching for... ` <strong>{{ $Search }}</strong>`
                </span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="SetSort('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4  "
                wire:click="SetSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->Posts as $Post)
            <x-posts.post-item :Post="$Post"></x-posts.post-item>
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->Posts->onEachSide(1)->links() }}
    </div>
</div>
