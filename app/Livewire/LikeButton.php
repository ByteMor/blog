<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{
    public Post $post;

    public function ToggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }

        $User = auth()->user();

        /**
         * If the user has already liked the post, we will detach the like
         */
        if ($User->HasLiked($this->post)) {
            $User->Likes()->detach($this->post->id);
            return;
        }

        /**
         * If the user has not liked the post, we will attach the like
         */
        $User->Likes()->attach($this->post->id);

    }

    public function render()
    {
        // dd($this->post);
        return view('livewire.like-button');
    }
}
