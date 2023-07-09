<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use App\Models\UserFollower;
use Livewire\Component;
use Livewire\WithPagination;

class PostItem extends Component
{
    // Compare this snippet from app/Http/Livewire/Profilepage/Show.php:
    protected $listeners = [
        'followed' => '$refresh',
        'follow' => 'follow',
    ];

    public $post;
    public function mount()
    {
        // $this->post = Post::find($postId);
    }

    public function follow(int $follower_id, int $followed_id){
        $follower = User::find($follower_id);
        $following = User::find($followed_id);

        if ($follower_id === $followed_id) {
            return;
        }

        if ($follower->following()->find($followed_id)) {
            $follower->following()->detach($followed_id);
        } else {
            $follower->following()->attach($followed_id);
        }

        // $this->emitSelf('followed');
    }


    public function render()
    {
        return view('livewire.post-item');
    }
}
