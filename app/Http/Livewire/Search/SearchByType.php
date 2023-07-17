<?php

namespace App\Http\Livewire\Search;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchByType extends Component
{
    // use WithPagination;

    // protected $listeners = [
    //     'searchResult' => '$refresh',
    //     'search' => 'searchBy',
    // ];

    public $perPage = 12;

    public $items;
    public $type;
    protected $searchResult;


    public function mount($items){
        $this->items = $items;
        $this->searchResult = [];
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    /**
     * Search for all posts by type, where type is either tag or category
     * and where name is the tag or category slug
     */
    public function searchBy($name, $type){
        // dd($name, $type);
        if($type === 'tag'){
            $posts = Post::whereRelation('tags', 'slug', $name)->get();
        } else {
            $posts = Post::whereRelation('categories', 'slug', $name)->get();
        }
        $this->searchResult = $posts;
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
