<?php

namespace App\Http\Livewire\User\Feed;

use App\Models\User;
use App\Utils\ContentBasedRecommender;
use Livewire\Component;

class PostsList extends Component
{
    public $posts;
    public $user;

    public function mount(User $user){
        $this->user = $user;
        $this->posts = ContentBasedRecommender::SuggestPostsFor($this->user->id);
        // dd($this->posts[0]->tags);
    }

    public function render()
    {
        return view('livewire.user.feed.posts-list', [
            'posts' => $this->posts
        ]);
    }
}
