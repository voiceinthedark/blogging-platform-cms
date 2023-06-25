<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'user_id' => 1,
                'bio' => 'Lorem ipsum',
            ],
            [
                'user_id' => 2,
                'bio' => 'Lorem ipsum',
            ],
            [
                'user_id' => 3,
                'bio' => 'Lorem ipsum',
            ]
        ];

        foreach ($profiles as $profile) {
            \App\Models\UserProfile::create($profile);
        }
    }
}
