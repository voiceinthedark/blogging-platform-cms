<?php

namespace App\Http\Livewire\User\Feed;

use Livewire\Component;

class Mainpage extends Component
{
    protected $listeners = [
        'loadComponent',
        'load' => '$refresh'
    ];
    public $currentComponent = 'posts-list';

    public function loadComponent($component)
    {
        $this->currentComponent = $component;
        $this->emitSelf('load');
    }
    public function render()
    {
        return view('livewire.user.feed.mainpage', [
            'component' => $this->currentComponent,
        ]);
    }
}
