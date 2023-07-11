<?php

namespace App\Http\Livewire\Search;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class SearchByType extends Component
{

    protected $listeners = ['searchResult' => '$refresh'];

    public $items;
    public $type;
    public $searchResult;

    public function mount($items){
        $this->items = $items;
        $this->searchResult = [];
    }

    /**
     * Search for all posts by type, where type is either tag or category
     * and where name is the tag or category slug
     */
    public function searchBy($name, $type){
        // $posts = Post::all();
        if($type === 'tag'){
            $posts = Post::whereRelation('tags', 'slug', $name)->get();
        } else {
            $posts = Post::whereRelation('categories', 'slug', $name)->get();
        }
        $this->searchResult = $posts;
        $this->emitSelf('searchResult');
        // dd($posts);
    }

    public function render()
    {
        return view('livewire.search.search-by-type', [
            'items' => $this->items,
            'type' => $this->type,
            'results' => $this->searchResult
        ]);
    }
}
