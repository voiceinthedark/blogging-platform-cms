<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowComments extends Component
{

    use WithPagination;

    protected $listeners = [
        'commentStored' => '$refresh',
    ];

    public $post;
    public $comment;
    protected $comments;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comment = '';
        $this->comments = Comment::rootComments()->where('post_id', $post->id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function storeComment(int $commentId = null)
    {
        $this->validate([
            'comment' => 'required|string|max:1024',
        ]);

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'content' => $this->comment,
            'parent_id' => $commentId,
            'level' => $commentId ? 1 : 0,
        ]);

        $this->emitSelf('commentStored');
        $this->resetfields();

        return response()->json([$this->post->comments->last()]);
    }

    public function resetfields()
    {
        $this->comment = '';
        $this->comments =
        Comment::rootComments()->where('post_id', $this->post->id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function render()
    {
        return view('livewire.comments.show-comments', [
            'comments' => Comment::rootComments()->where('post_id', $this->post->id)->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
