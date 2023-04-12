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
                "name" => "Fiction",
                "description" => "Literary works that describe imaginary events and people",
                "slug" => "fiction"
            ],
            [
                "name" => "Non-fiction",
                "description" => "Literary works that are based on facts and real events",
                "slug" => "non-fiction"
            ],
            [
                "name" => "Poetry",
                "description" => "Literary works that express feelings and ideas using a distinctive style and rhythm",
                "slug" => "poetry"
            ],
            [
                "name" => "Drama",
                "description" => "Literary works that are written to be performed in front of an audience",
                "slug" => "drama"
            ],
            [
                "name" => "Biography",
                "description" => "Literary works that describe the life of a real person",
                "slug" => "biography"
            ],
            [
                "name" => "Autobiography",
                "description" => "Literary works that describe the life of the author",
                "slug" => "autobiography"
            ],
            [
                "name" => "Fantasy",
                "description" => "Literary works that contain elements that are not real",
                "slug" => "fantasy"
            ],
            [
                "name" => "Science fiction",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "science-fiction"
            ],
            [
                "name" => "Horror",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "horror"
            ],
            [
                "name" => "Mystery",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "mystery"
            ],
            [
                "name" => "Thriller",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "thriller"
            ],
            [
                "name" => "Romance",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "romance"
            ],
            [
                "name" => "Historical fiction",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "historical-fiction"
            ],
            [
                "name" => "Young adult",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "young-adult"
            ],
            [
                "name" => "Children's",
                "description" => "Liter ary works that contain elements that are not real and are set in the future",
                "slug" => "childrens"
            ],
            [
                "name" => "Self-help",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "self-help"
            ],
            [
                "name" => "Guide",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "guide"
            ],
            [
                "name" => "Travel",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "travel"
            ],
            [
                "name" => "Health",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "health"
            ],
            [
                "name" => "History",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "history"
            ],
            [
                "name" => "Math",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "math"
            ],
            [
                "name" => "Science",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "science"
            ],
            [
                "name" => "Religion",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "religion"
            ],
            [
                "name" => "Spirituality",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "spirituality"
            ],
            [
                "name" => "Philosophy",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "philosophy"
            ],
            [
                "name" => "Psychology",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "psychology"
            ],
            [
                "name" => "Self-improvement",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "self-improvement"
            ],
            [
                "name" => "Personal growth",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "personal-growth"
            ],
            [
                "name" => "Motivational",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "motivational"
            ],
            [
                "name" => "Inspiration",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "inspiration"
            ],
            [
                "name" => "Humor",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "humor"
            ],
            [
                "name" => "Comedy",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "comedy"
            ],
            [
                "name" => "Anecdotes",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "anecdotes"
            ],
            [
                "name" => "Dictionaries",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "dictionaries"
            ],
            [
                "name" => "Thesauruses",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "thesauruses"
            ],
            [
                "name" => "Encyclopedias",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "encyclopedias"
            ],
            [
                "name" => "Comics",
                "description" => "Literary works that contain elements that are not real and are set in the future",
                "slug" => "science-fiction",
            ],
        ];

        foreach ($categories as $category) {
            Category::factory()->create($category);
        }
    }
}
