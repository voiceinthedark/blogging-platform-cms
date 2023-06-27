<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            // 'user_id' => User::factory()->create()->id,
            'title' => $title,
            'content' => $this->faker->paragraph(5),
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(1),
        ];
    }
}