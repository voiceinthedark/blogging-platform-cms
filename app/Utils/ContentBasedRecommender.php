<?php

namespace App\Utils;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ContentBasedRecommender
{
    public function __construct(){

    }

    public static function SuggestPostsFor($userId, $limit = 10)
    {
        $user = User::find($userId);

        $likes = $user->likes;
        // dd($likes);

        // group user likes by post tags and count
        $tags = [];
        foreach ($likes as $like) {
            foreach ($like->post->tags as $tagPost) {
                // dd($tagPost->id);
                if (isset($tags[$tagPost->id])) {
                    $tags[$tagPost->id] += 1;
                } else {
                    $tags[$tagPost->id] = 1;
                }
            }
        }

        // dd($tags);

        // sort tags by count
        arsort($tags);
        // Find posts where its tags relationship has most likes and count in the tags aray
        $posts = DB::table('posts')->join('post_tag', 'posts.id', '=', 'post_tag.post_id')->select('posts.*')->whereIn('post_tag.tag_id', array_keys($tags))->get();
        $tagsNames = [];
        foreach ($tags as $key => $tag) {
            $tagsNames[] = Tag::find($key)->name;
        }
        // dd($tagsNames, $posts);
        // Get Random Posts from posts where its tags relationship has most likes and count in the tags aray
        $posts = $posts->random($limit);
        // dd($posts);
        return $posts;
    }
}
