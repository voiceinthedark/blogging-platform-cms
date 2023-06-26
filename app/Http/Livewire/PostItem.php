<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostItem extends Component
{
    public $post;
    public function mount()
    {
        // $this->post = Post::find($postId);

    }
    public function render()
    {
        return view('livewire.post-item');
    }
}
