<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Software Engineering',
                'slug' => 'software-engineering',
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
            ],
            [
                'name' => 'Machine Learning',
                'slug' => 'machine-learning',
            ],
            [
                'name' => 'Blockchain',
                'slug' => 'blockchain',
            ],
            [
                'name' => 'Cloud',
                'slug' => 'cloud',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
