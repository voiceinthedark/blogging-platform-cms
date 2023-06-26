<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    protected $posts;


    public function mount(){
        $this->posts = Post::orderBy('created_at', 'desc')->paginate(10);
    }

    public function render()
    {
        return view('livewire.show-posts', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
