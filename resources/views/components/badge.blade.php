@props(['TextColor', 'BackgroundColor'])

@php
    $TextColor = match ($TextColor) {
        'red' => 'text-red-600',
        'green' => 'text-green-600',
        'blue' => 'text-blue-600',
        'yellow' => 'text-yellow-600',
        'indigo' => 'text-indigo-600',
        'purple' => 'text-purple-600',
        'pink' => 'text-pink-600',
        'gray' => 'text-gray-600',
        'white' => 'text-white',
        'black' => 'text-black',
        default => 'text-gray-600',
    };

    $BackgroundColor = match ($BackgroundColor) {
        'red' => 'bg-red-100',
        'green' => 'bg-green-100',
        'blue' => 'bg-blue-100',
        'dark-blue' => 'bg-blue-900',
        'yellow' => 'bg-yellow-100',
        'indigo' => 'bg-indigo-100',
        'purple' => 'bg-purple-100',
        'php' => 'bg-indigo-500',
        'pink' => 'bg-pink-100',
        'gray' => 'bg-gray-100',
        'white' => 'bg-white',
        'black' => 'bg-black',
        default => 'bg-gray-100',
    };

@endphp

<button {{ $attributes }} class="{{ $BackgroundColor }} {{ $TextColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>
