<?php

namespace App\Http\Livewire\User\Feed;

use Livewire\Component;

class PostsListItem extends Component
{
    protected $post;

    public function mount($post){
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.user.feed.posts-list-item', [
            'post' => $this->post,
        ]);
    }
}
