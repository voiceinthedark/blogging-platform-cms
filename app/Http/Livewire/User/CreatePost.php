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

    //? Add listenener to Browser event?
    protected $listeners = [
        'getReadingTime' => 'getReadingTime',
    ];


    protected $rules = [
        'title' => ['required', 'max:255', 'string'],
        'content' => ['required', 'string'],
        'tagCollection' => ['array'],
        'categoryCollection' => ['array'],
    ];

    /**
     * *For Editing mount the post
     */
    public $post;

    public $title;
    public $content;
    public $tags;
    public $tagSearch;
    public $categories;
    public $categorySearch;
    public $tagCollection;
    public $categoryCollection;
    public $wordCount;
    public $timeToRead;

    //? Use the same code for editing as well? Mounting the Post Component??

    public function mount()
    {
        $this->title =  '';
        $this->content =  '';
        $this->tags = Tag::all();
        $this->tagSearch = '';
        $this->categories = Category::all();
        $this->categorySearch = '';
        $this->wordCount = 0;
        $this->timeToRead = 0;

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetFields()
    {
        $this->title = '';
        $this->content = '';
    }

    public function updatedTagSearch()
    {
        $this->tags = Tag::where('name', 'LIKE', '%' . $this->tagSearch . '%')->get();
    }

    public function updatedCategorySearch()
    {
        $this->categories = Category::where('name', 'LIKE', '%' . $this->categorySearch . '%')->get();
    }

    public function updatedContent($value): void
    {
        // dd($value);
    }

    public function getReadingTime($wordCount): void
    {
        $this->timeToRead = ceil($wordCount / 200);
    }

    public function create()
    {

        // $this->validate();

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'content' => $this->content,
            // TODO: Excerpt when getting full HTML output
            'excerpt' => Str::excerpt($this->content),
            'slug' => Str::slug($this->title),
            'word_count' => $this->wordCount,
            'minutes' => $this->timeToRead,
        ]);


        $post->tags()->attach($this->tagCollection);
        $post->categories()->attach($this->categoryCollection);


        $this->reset();
        $this->tags = Tag::all();
        $this->categories = Category::all();
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
