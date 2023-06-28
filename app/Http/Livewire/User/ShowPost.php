<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPost extends Component
{

    public $post;

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
