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
        'tags' => ['array'],
        'categories' => ['array'],
    ];

    /**
     * *For Editing mount the post
     */
    public $post;

    public $title;
    public $content;
    public $tags;
    public $categories;
    public $wordCount;
    public $timeToRead;
    public $tagsToCreate;
    public $categoriesToCreate;

    //? Use the same code for editing as well? Mounting the Post Component??
    protected $listeners = [
        'getReadingTime' => 'getReadingTime',
    ];



    public function mount($post)
    {
        $this->post = $post;
        $this->title = $this->post->title ?? '';
        $this->content = $this->post->content ?? '';
        $this->tags = $this->post->tags->map(function ($tag) {
            return $tag->slug;
        })->toArray();
        $this->categories = $this->post->categories->map(function ($category) {
            return $category->slug;
        })->toArray();
        $this->wordCount = $this->post->word_count;
        $this->timeToRead = $this->post->minutes;
        $this->tagsToCreate = [];
        $this->categoriesToCreate = [];

        $this->updateEditorContent();
    }

    public function updateEditorContent(){
        $this->dispatchBrowserEvent('updateEditorContent', $this->content);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

        // dd($this->tags, $this->categories);

        $post = Post::find($this->post->id);

        $post->update([
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => Str::excerpt($this->content),
            'slug' => Str::slug($this->title),
            'word_count' => $this->wordCount,
            'minutes' => $this->timeToRead,
        ]);

        // Process Tags and convert objects to string
        // $this->tags = array_map(function ($tag) {
        //     if(!is_string($tag)) {
        //         $tag = $tag->slug;
        //     }
        //     return $tag;
        // }, $this->tags->toArray());

        // dd($this->tags);

        // Update the categories and tags
        foreach ($this->tags as $tag) {
            $newTag = Tag::updateOrCreate(
                ['name' => $tag],
                ['name' => $tag, 'slug' => $tag]
            );
            $this->tagsToCreate[] = $newTag->id;
        }

        // Process Categories
        // update or create categories in db
        foreach ($this->categories as $category) {
            $newCategory = Category::updateOrCreate(
                ['name' => $category],
                ['name' => $category, 'slug' => $category]
            );
            $this->categoriesToCreate[] = $newCategory->id;
        }

        // dd($this->tagsToCreate, $this->categoriesToCreate);

        $post->tags()->sync($this->tagsToCreate);
        $post->categories()->sync($this->categoriesToCreate);


        session()->flash('flash.banner', 'Post Updated');
        session()->flash('flash.bannerStyle', 'success');

        return redirect('/dashboard');
    }

    public function render()
    {
        // dd($this->tags, $this->categories);
        return view('livewire.user.edit-post', [
            'tags' => $this->tags,
            'categories' => $this->categories,
        ]);
    }
}
