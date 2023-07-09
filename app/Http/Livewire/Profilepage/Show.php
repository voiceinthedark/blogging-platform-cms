<?php

namespace App\Http\Livewire\Profilepage;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{

    protected $listeners = [
        'followed' => '$refresh',
        // Follow from outside of the component
        'follow' => 'follow',
    ];

    public $user;

    public function mount($user){
        $this->user = $user;
    }

    public function follow(int $follower_id, int $followed_id){
        $follower = User::find($follower_id);
        $following = User::find($followed_id);

        // dd($follower, $following);

        if($follower_id === $followed_id){
            return;
        }

        if($follower->following()->find($followed_id)){
            $follower->following()->detach($followed_id);
        } else{
            $follower->following()->attach($followed_id);
        }

        $this->emitSelf('followed');
        // $this->emitTo('post-item', 'followed');
    }


    public function render()
    {
        return view('livewire.profilepage.show');
    }
}
