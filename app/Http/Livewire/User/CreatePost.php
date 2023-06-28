<?php

namespace App\Http\Livewire\User;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Str;

class CreatePost extends Component
{

    protected $rules = [
        'title' => ['required', 'max:255', 'string'],
        'content' => ['required', 'string'],
    ];

    public $title;
    public $content;
    public $tags;
    public $tagSearch;
    public $categories;
    public $categorySearch;

    public function mount(){
        $this->title = '';
        $this->content = '';
        $this->tags = Tag::all();
        $this->tagSearch = '';
        $this->categories = Category::all();
        $this->categorySearch = '';
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function resetFields(){
        $this->title = '';
        $this->content = '';
    }

    public function updatedTagSearch(){
        $this->tags = Tag::where('name', 'LIKE', '%' . $this->tagSearch . '%')->get();
    }

    public function updatedCategorySearch(){
        $this->categories = Category::where('name', 'LIKE', '%' . $this->categorySearch . '%')->get();
    }

    public function create(){

        $this->validate();

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => Str::excerpt($this->content),
            'slug' => Str::slug($this->title),
        ]);

        $this->reset();
        $this->emit('createPost');

        session()->flash('flash.banner', 'Post Created');
        session()->flash('flash.bannerStyle', 'success');

        return redirect('/dashboard');

    }

    public function render()
    {
        return view('livewire.user.create-post');

    }
}
