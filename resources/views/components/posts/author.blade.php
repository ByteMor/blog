@props(['author', 'size'])

@php

    $size ??= null;

    $ImageSize = match ($size) {
        'small' => 'w-7 h-7',
        'medium' => 'w-10 h-10',
        'large' => 'w-12 h-12',
        default => 'w-7 h-7',
    };

    $TextSize = match ($size) {
        'small' => 'text-sm',
        'medium' => 'text-base',
        'large' => 'text-lg',
        default => 'text-sm',
    };

@endphp
<img class="{{ $ImageSize }} rounded-full mr-3" src="{{ $author->profile_photo_url }}" alt="avatar">
<span class="mr-1 {{ $TextSize }}">{{ $author->name }}</span>
