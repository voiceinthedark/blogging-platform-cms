<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPostList extends Component
{
    use WithPagination;

    protected $posts;
    public $search;

    public function mount(){
        $this->search = '';
        $this->posts = Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
    }

    // Add search functionality
    public function updatedSearch(){
        $this->posts = Post::where('user_id', auth()->user()->id)->where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate(5);
    }


    public function deletePost($id){
        Post::find($id)->delete();
    }
    public function render()
    {
        return view('livewire.user.show-post-list', [
            'posts' => $this->posts,
        ]);
    }
}
