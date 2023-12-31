<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserFollower;
use App\Models\UserProfile;
use Database\Factories\FollowerFactory;
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
        // $this->call(UserSeeder::class);
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
                Post::factory(rand(1, 10))->create([
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

        $usersCount = User::all()->count();

        // Run the Follower factory
        UserFollower::factory(1000)->create()
        ->each(function ($follower) use ($usersCount) {
            $follower->update([
                'follower_id' => rand(1, $usersCount)
            ]);

            // Make sure the follower_id is not equal to following_id
            while ($follower->follower_id === $follower->following_id) {
                $follower->update([
                    'followed_id' => rand(1, $usersCount)
                ]);
            }
        });

        // Add Likes to Posts and Comments
        PostLike::factory(10000)->create();
        CommentLike::factory(10000)->create();

    }
}
