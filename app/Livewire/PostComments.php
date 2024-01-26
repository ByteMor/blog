<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;

    #[Rule([
        'required',
        'min:4',
        'max:200',
    ])]
    public string $comment;

    public function PostComment()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $this->post->comments()->create(
            [
                'comment' => $this->comment,
                'user_id' => auth()->id(),
            ]
        );

        $this->reset('comment');
    }

    #[Computed()]
    public function Comments()
    {
        return $this?->post->comments()->latest()->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
