<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-2">
        @foreach ($Categories as $Category)
            <x-posts.category-badge :Category="$Category"></x-posts.category-badge>
        @endforeach
    </div>
</div>
