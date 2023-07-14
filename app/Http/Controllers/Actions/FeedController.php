<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Utils\ContentBasedRecommender;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $posts = ContentBasedRecommender::SuggestPostsFor($user->id);
        return view('user.feed.main', [
            'posts' => $posts
        ]);
    }
}
