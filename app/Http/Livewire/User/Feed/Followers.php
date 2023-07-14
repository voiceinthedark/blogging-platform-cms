<?php

namespace App\Http\Livewire\User\Feed;

use Livewire\Component;

class Followers extends Component
{
    public $user;
    public function mount(){
        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.user.feed.followers', [
            'user' => $this->user
        ]);
    }
}
