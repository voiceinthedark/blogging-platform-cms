<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserFollower>
 */
class UserFollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersCount = User::all()->count();

        return [
            'follower_id' => rand(1, $usersCount),
            'followed_id' => rand(1, $usersCount),
        ];
    }
}
