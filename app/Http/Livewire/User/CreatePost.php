<?php

namespace App\Http\Livewire\User;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostCreated;
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
        'tags' => ['array'],
        'categories' => ['array'],
    ];

    /**
     * *For Editing mount the post
     */
    public $post;

    public $title;
    public $content;
    public $tagsDB;
    public $categoriesDB;
    public $tags;
    public $categories;
    public $tagsToCreate;
    public $categoriesToCreate;
    public $wordCount;
    public $timeToRead;

    //? Use the same code for editing as well? Mounting the Post Component??

    public function mount()
    {
        $this->title =  '';
        $this->content =  '';
        $this->tagsDB = Tag::all();
        $this->tags = [];
        $this->categoriesDB = Category::all();
        $this->categories = [];
        $this->tagsToCreate = [];
        $this->categoriesToCreate = [];
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

    public function updatedContent($value): void
    {
        // dd($value);
    }

    public function updatedTags($value): void
    {
        $this->tags = $value;
        // dump($this->tags);
    }

    public function updatedCategories($value): void{
        $this->categories = $value;
        // dump($this->categories);
    }

    public function getReadingTime($wordCount): void
    {
        $this->timeToRead = ceil($wordCount / 200);
    }

    public function create()
    {

        $this->validate();

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

        // Process Tags
        // update or create tags in db

        foreach ($this->tags as $tag) {
            $newTag = Tag::updateOrCreate(
                ['name' => $tag],
                ['name' => Str::camel($tag), 'slug' => $tag]
            );
            $this->tagsToCreate[] = $newTag->id;
        }

        // Process Categories
        // update or create categories in db
        foreach ($this->categories as $category) {
            $newCategory = Category::updateOrCreate(
                ['name' => $category],
                ['name' => Str::camel($category), 'slug' => $category]
            );
            $this->categoriesToCreate[] = $newCategory->id;
        }

        $post->tags()->sync($this->tagsToCreate);
        $post->categories()->sync($this->categoriesToCreate);


        $this->reset();
        $this->tagsDB = Tag::all();
        $this->categoriesDB = Category::all();
        $this->emit('createPost');

        session()->flash('flash.banner', 'Post Created');
        session()->flash('flash.bannerStyle', 'success');

        // Notify followers of new post
        $users = $post->user->followers;
        $users->each(function ($user) use ($post) {
            $user->notify(new PostCreated($post));
        });

        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.user.create-post');
    }
}
