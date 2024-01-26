@props(['Category'])
<x-badge wire:navigate href="{{ route('posts.index', ['Category' => $Category->title]) }}" :TextColor="$Category->text_color"
    :BackgroundColor="$Category->background_color">
    {{ $Category->title }}
</x-badge>
