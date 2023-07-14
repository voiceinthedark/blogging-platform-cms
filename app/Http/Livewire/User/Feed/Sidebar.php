<?php

namespace App\Http\Livewire\User\Feed;

use Livewire\Component;

class Sidebar extends Component
{
    public function loadComponent($component){
        $this->emitTo('user.feed.mainpage', 'loadComponent', $component);
    }
    public function render()
    {
        return view('livewire.user.feed.sidebar');
    }
}
