@props(['Post'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{ route('posts.show', $Post->slug) }}">
                <img class="mw-100 mx-auto rounded-xl" src="{{ $Post->GetThumbnailImage() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <x-posts.author :size="'small'" :author="$Post->author"></x-posts.author>
                <span class="text-gray-500 text-xs">{{ $Post->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('posts.show', $Post->slug) }}">
                    {{ $Post->title }}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{ $Post->GetExcerpt() }}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                <div class="flex gap-x-5">
                    @foreach ($Post->Categories as $Category)
                        <x-posts.category-badge :Category="$Category"></x-posts.category-badge>
                    @endforeach
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500 text-sm">{{ $Post->GetReadingTime() }} min read</span>
                    </div>
                </div>

                {{-- Like Button --}}
                <div>
                    <livewire:like-button :key="$Post->id" :Post="$Post" />
                </div>
            </div>
        </div>
    </div>
</article>
