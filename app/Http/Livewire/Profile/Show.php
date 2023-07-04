<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Show extends Component
{
    public $user;

    public function mount($user){
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile.show');
    }
}
