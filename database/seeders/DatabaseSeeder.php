<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Run the seeders
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        // $this->call(UserProfileSeeder::class);

        // Run the user factory
        User::factory(100)->create()->each(
            function ($user) {
                UserProfile::factory()->create([
                    'user_id' => $user->id
                ]);

                $user->roles()->attach(Role::where('name', 'user')->first());
                Post::factory(rand(1, 5))->create([
                    'user_id' => $user->id
                ])->each(function ($post) use ($user) {
                    $tags = Tag::all();
                    $categories = Category::all();
                    $post->tags()->attach($tags->random(rand(1, 3)));
                    $post->categories()->attach($categories->random(rand(1, 3)));
                });
            }
        );

        // Run the Comment factory
        Comment::factory(600)->create();


    }
}
