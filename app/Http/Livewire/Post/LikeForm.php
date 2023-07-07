<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\PostLike;
use Livewire\Component;

class LikeForm extends Component
{

    public $likes;
    public $dislikes;
    public $post;
    public $user;

    public function mount(Post $post){
        $this->likes = $post->likesCount();
        $this->dislikes = $post->dislikesCount();
        $this->post = $post;
        $this->user = auth()->user();
    }

    public function updateLikeStatus($postId, $userId, $action)
    {
        $postLike = PostLike::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($postLike) {
            if ($action === 'like') {
                $postLike->like_status == 0 ? $postLike->like_status = 1 : $postLike->like_status = 0; // Unlike
            } elseif ($action === 'dislike') {
                $postLike->like_status == 0 ? $postLike->like_status = -1 : $postLike->like_status = 0; // Undislike
            }
            $postLike->save();
        } else {
            $likeStatus = ($action === 'like') ? 1 : -1;
            PostLike::create([
                'post_id' => $postId,
                'user_id' => $userId,
                'like_status' => $likeStatus,
            ]);
        }
        $this->likes = $this->post->likesCount();
        $this->dislikes = $this->post->dislikesCount();

        $this->emit('refreshLikes');
    }

    public function render()
    {
        return view('livewire.post.like-form', [
            'post' => $this->post,
        ]);
    }
}
