<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{

    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $Search = "";

    #[Url()]
    public $Category = "";

    public function SetSort($Sort)
    {

        $this->sort = ($Sort === 'asc') ? 'asc' : 'desc';
    }

    #[On('Search')]
    public function UpdateSearch($Search)
    {
        $this->Search = $Search;
    }

    #[Computed]
    public function Posts()
    {
        return Post::published()
            ->when($this->ActiveCategory, function ($Query) {
                $Query->withCategory($this->Category);
            })
            ->where('title', 'like', "%{$this->Search}%")
            ->orderBy('published_at', $this->sort)
            ->paginate(5);
    }

    #[Computed()]
    public function ActiveCategory()
    {
        return Category::where('slug', $this->Category)->first();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
