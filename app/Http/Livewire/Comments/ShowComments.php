<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class ShowComments extends Component
{

    protected $listeners = [
        'commentStored' => '$refresh',
    ];

    public $post;
    public $comment;
    public $comments;

    public function mount(Post $post){
        $this->post = $post;
        $this->comment = '';
        $this->comments = Comment::rootComments()->where('post_id', $post->id)->get();
    }

    public function storeComment(int $commentId = null){
        $this->validate([
            'comment' => 'required'
        ]);

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'content' => $this->comment,
            'parent_id' => $commentId,
            'level' => $commentId ? 1 : 0,
        ]);

        $this->emitSelf('commentStored');
        // $this->reset();

        return response()->json([$this->post->comments->last()]);
    }

    public function render()
    {
        return view('livewire.comments.show-comments', [
            'comments' => Comment::rootComments()->where('post_id', $this->post->id)->get(),
        ]);
    }
}
