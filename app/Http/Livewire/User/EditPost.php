<?php

namespace App\Http\Livewire\User;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class EditPost extends Component
{

    //? Add listenener to Browser event?


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
    protected $listeners = [
        'getReadingTime' => 'getReadingTime',
    ];

    public function mount($post)
    {
        $this->post = $post;
        $this->title = $this->post->title ?? '';
        $this->content = $this->post->content ?? '';
        $this->tagCollection = $this->post->tags;
        $this->tagSearch = '';
        $this->tags= Tag::all();
        $this->categoryCollection = $this->post->categories;
        $this->categorySearch = '';
        $this->categories = Category::all();
        $this->wordCount = $this->post->word_count;
        $this->timeToRead = $this->post->minutes;
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

    public function update()
    {

        $this->validate();

        $post = Post::find($this->post->id);

        $post->update([
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => Str::excerpt($this->content),
            'slug' => Str::slug($this->title),
            'word_count' => $this->wordCount,
            'minutes' => $this->timeToRead,
        ]);

        $post->tags()->sync($this->tagCollection);
        $post->categories()->sync($this->categoryCollection);


        session()->flash('flash.banner', 'Post Updated');
        session()->flash('flash.bannerStyle', 'success');

        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.user.edit-post', [
            'tags' => $this->tagCollection,
            'categories' => $this->categoryCollection,
        ]);
    }
}
