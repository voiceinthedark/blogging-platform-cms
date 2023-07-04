<?php

namespace App\Http\Livewire\Profile;

use App\Models\Post;
use Livewire\Component;

class ShowUserArticles extends Component
{
    public $user;
    protected $posts;
    public $search;

    public function mount($user){
        $this->user = $user;
        $this->posts = $user->posts;
        $this->search = '';
    }

    public function updatingSearch(){
        $this->posts = Post::where('user_id', $this->user->id)->where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function render()
    {
        return view('livewire.profile.show-user-articles', [
            'user' => $this->user,
            'posts' => Post::where('user_id', $this->user->id)->where('title', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate(5),

        ]);
    }
}
