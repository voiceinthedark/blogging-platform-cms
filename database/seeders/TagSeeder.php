<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'PHP',
                'slug' => 'php',
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
            ],
            [
                'name' => 'Vue',
                'slug' => 'vue',
            ],
            [
                'name' => 'Lumen',
                'slug' => 'lumen',
            ],
            [
                'name' => 'React',
                'slug' => 'react',
            ],
            [
                'name' => 'Tailwind',
                'slug' => 'tailwind',
            ]
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
