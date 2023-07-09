<?php

namespace App\Http\Livewire\Profilepage;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserComments extends Component
{
    use WithPagination;

    // protected $listeners = [
    //     'followed' => '$refresh'
    // ];

    public $user;
    protected $comments;

    public function mount($user){
        $this->user = $user;
        $this->comments = Comment::where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate(5);
    }
    public function render()
    {
        return view('livewire.profilepage.show-user-comments',
            [
                'user' => $this->user,
                'comments' => Comment::where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate(5),
            ]);
    }
}
