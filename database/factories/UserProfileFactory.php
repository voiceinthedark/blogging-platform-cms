<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
            'bio' => $this->faker->paragraph(5),
            // 'profile_photo_path' => $this->faker->image('app/public/profile-photos', 256, 256, 'animals', false),
            'twitter' => $this->faker->userName(),
            'facebook' => $this->faker->userName(),
            'instagram' => $this->faker->userName(),
            'github' => $this->faker->userName(),
        ];
    }
}
