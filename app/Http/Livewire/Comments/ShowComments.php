<?php

namespace App\Http\Livewire\Comments;

use App\Models\Post;
use Livewire\Component;

class ShowComments extends Component
{
    public $post;
    public $comments;

    public function mount(Post $post){
        $this->post = $post;
        $this->comments = $post->comments;
    }

    public function render()
    {
        return view('livewire.comments.show-comments');
    }
}
