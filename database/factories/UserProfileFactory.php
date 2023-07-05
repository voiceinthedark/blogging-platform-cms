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
            'username' => Str::snake($this->faker->firstName() . $this->faker->lastName()),
            'bio' => $this->faker->paragraph(5),
            // 'profile_photo_path' => $this->faker->image('app/public/profile-photos', 256, 256, 'animals', false),
            'twitter' => Str::snake($this->faker->firstName() . $this->faker->lastName()),
            'facebook' => Str::snake($this->faker->firstName() . $this->faker->lastName()),
            'instagram' => Str::snake($this->faker->firstName() . $this->faker->lastName()),
            'github' => Str::snake($this->faker->firstName() . $this->faker->lastName()),
        ];
    }
}
