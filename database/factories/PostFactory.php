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
        $content = $this->faker->paragraph(5);

        return [
            'title' => $title,
            'content' => $content,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(1),
            'word_count' => Str::wordCount($content),
            'minutes' => rand(1, 5),
            'created_at' => $this->faker->dateTimeThisYear(),
            'updated_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
