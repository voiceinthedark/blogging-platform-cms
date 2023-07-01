<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    protected $listeners = [
        'searchValueChange' => 'setSearch',
    ];

    protected $posts;
    public $search;


    public function mount(){
        $this->posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $this->search = '';
    }


    public function setSearch($value){
        $this->search = $value;
        $this->resetPage();
    }

    public function render()
    {
        // $this->posts = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.show-posts', [
            'posts' => Post::where('title', 'LIKE', '%' . $this->search . '%')->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
