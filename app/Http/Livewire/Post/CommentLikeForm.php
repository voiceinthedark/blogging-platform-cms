<?php

namespace App\Http\Livewire\Post;

use App\Models\Comment;
use App\Models\CommentLike;
use Livewire\Component;

class CommentLikeForm extends Component
{

    public $likes;
    public $dislikes;
    public $comment;
    public $user;

    public function mount(Comment $comment){
        $this->likes = $comment->likesCount();
        $this->dislikes = $comment->dislikesCount();
        $this->comment = $comment;
        $this->user = auth()->user();
    }

    public function updateLikeStatus($commentId, $userId, $action){
        $commentLike = CommentLike::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if ($commentLike){
            if ($action === 'like'){
                $commentLike->like_status == 0 ? $commentLike->like_status = 1 : $commentLike->like_status = 0; // Unlike
            } elseif ($action === 'dislike'){
                $commentLike->like_status == 0 ? $commentLike->like_status = -1 : $commentLike->like_status = 0; // Undislike
            }
            $commentLike->save();
        } else {
            $likeStatus = ($action === 'like') ? 1 : -1;
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id' => $userId,
                'like_status' => $likeStatus,
            ]);
        }

        $this->likes = $this->comment->likesCount();
        $this->dislikes = $this->comment->dislikesCount();

        // TODO: Fix list populating in real time
        $this->emit('refreshLikes');

    }

    public function render()
    {
        return view('livewire.post.comment-like-form', [
            'comment' => $this->comment,
        ]);
    }
}
