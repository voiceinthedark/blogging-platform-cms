<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{

    use WithPagination;

    protected $posts;

    public function render()
    {
        return view('livewire.user.show-posts', [
            'posts' => Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10),
        ] );
    }
}
