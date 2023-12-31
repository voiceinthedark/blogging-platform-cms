<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Utils\WeightedRandom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostLike>
 */
class PostLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersCount = User::all()->count();
        $postsCount = Post::all()->count();

        return [
            'user_id' => rand(1, $usersCount),
            'post_id' => rand(1, $postsCount),
            'like_status' => WeightedRandom::getRandomWeightedElement([
                -1 => 15, // 15% chance to dislike
                0 => 5, // 5% chance to abstain
                1 => 80 // 80% chance to like
            ]),
        ];
    }
}
