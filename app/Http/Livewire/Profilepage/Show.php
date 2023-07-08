<?php

namespace App\Http\Livewire\Profilepage;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $user;

    public function mount($user){
        $this->user = $user;
    }

    public function follow(int $follower_id, int $followed_id){
        $follower = User::find($follower_id);
        $following = User::find($followed_id);

        if($follower_id === $followed_id){
            return;
        }

        if($follower->following()->find($followed_id)){
            $follower->following()->detach($followed_id);
        } else{
            $follower->following()->attach($followed_id);
        }
    }


    public function render()
    {
        return view('livewire.profilepage.show');
    }
}
