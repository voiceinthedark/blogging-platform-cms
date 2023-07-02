<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ShowPost extends Component
{

    public $post;

    public function editPost($id){
        $this->post = Post::find($id);
        return view('posts.create', ['post' => $this->post]);
    }

    public function deletePost($id)
    {
        Post::find($id)->delete();
        // Send event to refresh the list
        $this->emitTo('user.show-post-list', 'postDeleted');
    }

    public function render()
    {
        return view('livewire.user.show-post');
    }
}
