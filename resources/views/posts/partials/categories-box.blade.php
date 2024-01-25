<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-2">
        @foreach ($Categories as $Category)
            <x-badge wire:navigate href="{{ route('posts.index', ['Category' => $Category->title]) }}" :TextColor="$Category->text_color"
                :BackgroundColor="$Category->background_color">
                {{ $Category->title }}
            </x-badge>
        @endforeach
    </div>
</div>
