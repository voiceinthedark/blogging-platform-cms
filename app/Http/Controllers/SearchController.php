<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public $items;
    public function SearchByType($type)
    {
        $type === 'tag' ? $this->items = Tag::all() : $this->items = Category::all();

        return view('search.search-page', [
            'type' => $type,
            'items' => $this->items,
        ]);
    }
}
