<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class ShowLatest extends Component
{
    public $posts;

    public function mount(){
        $this->posts = Post::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.post.show-latest');
    }
}
