    @props(['FeaturedPost'])
    <div {{ $attributes }}>
        <a href="#">
            <div
                class="hover:border-red-500 rounded-lg border-solid border-4 border-yellow-500 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                <img class="w-full rounded-xl object-cover  h-48" src="{{ $FeaturedPost->GetThumbnailImage() }}">
            </div>
        </a>

        <div class="mt-3">
            <div class="flex items-center mb-2 gap-2">
                <p class="text-gray-500 text-sm">{{ $FeaturedPost->published_at }}</p>
                @if ($Category = $FeaturedPost->Categories->first())
                    <x-badge wire:navigate href="{{ route('posts.index', ['Category' => $Category->title]) }}"
                        :TextColor="$Category->text_color" :BackgroundColor="$Category->background_color">
                        {{ $Category->title }}
                    </x-badge>
                @endif
            </div>
            <a href="#" class="text-xl font-bold text-gray-900">{{ $FeaturedPost->title }}</a>
        </div>
    </div>
