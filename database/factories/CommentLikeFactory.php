<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentLike>
 */
class CommentLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersCount = User::all()->count();
        $commentCount = Comment::all()->count();
        return [
            'user_id' => rand(1, $usersCount),
            'comment_id' => rand(1, $commentCount),
            'like_status' => rand(-1, 1),
        ];
    }
}
