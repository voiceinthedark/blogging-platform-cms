<?php

namespace App\Http\Livewire\Profilepage;

use Livewire\Component;

class Show extends Component
{
    public $user;

    public function mount($user){
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profilepage.show');
    }
}
