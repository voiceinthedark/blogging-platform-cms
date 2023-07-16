<?php

namespace App\Http\Controllers;

use App\Events\SendPostContent;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard', [
            'posts' => Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Str::of($post->content)->words(20);
        $post->increment('views');
        // $this->sendPostContent($post->content);
        return view('posts.show', [
            'post' => $post,
            'comments' => Comment::rootComments()->where('post_id', $post->id)->get(),
        ]);
    }

    public function sendPostContent($payload){
        // dd($payload);
        event(new SendPostContent($payload));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Enfore policy
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Enfore policy
        $this->authorize('delete', $post);
    }

    // Get Latest Posts
    public function latestPosts(){
        return Post::latest()->take(5)->get();
    }
}
