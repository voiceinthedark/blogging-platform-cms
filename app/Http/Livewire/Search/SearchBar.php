<?php

namespace App\Http\Livewire\Search;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;

    protected $listeners = [
        'searchValueChange' => 'search',
        'show-post' => 'showPost',
    ];

    public $search;
    protected $results;

    public function mount(){
        $this->results = Post::all();
    }

    public function search($value){
        $this->search = $value;

        $this->results = Post::search($this->search)->get();
        $this->dispatchBrowserEvent('search', ['results' => $this->results]);
    }

    public function showPost($postItem){
        // dd($post);
        $post = Post::find($postItem['id']);
        return redirect(route('posts.show', $post->slug));

    }

    public function render()
    {
        return view('livewire.search.search-bar', [
            'posts' => $this->results,
        ]);
    }
}
