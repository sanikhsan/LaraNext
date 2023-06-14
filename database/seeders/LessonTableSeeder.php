<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'name' => 'Javascript 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 1
            ],
            [
                'name' => 'Javascript 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 1
            ],
            [
                'name' => 'React 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 2,
            ],
            [
                'name' => 'React 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 2,
            ],
            [
                'name' => 'React Basic 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 3,
            ],
            [
                'name' => 'React Basic 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 3,
            ],
            [
                'name' => 'Golang 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 4,
            ],
            [
                'name' => 'Golang 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 4,
            ],
            [
                'name' => 'Golang Basic 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 5,
            ],
            [
                'name' => 'Golang Basic 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 5,
            ],
            [
                'name' => 'Dart 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 6,
            ],
            [
                'name' => 'Dart 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 6,
            ],
            [
                'name' => 'Flutter 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 7,
            ],
            [
                'name' => 'Flutter 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 7,
            ],
            [
                'name' => 'Flutter Basic 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 8,
            ],
            [
                'name' => 'Flutter Basic 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 8,
            ],
            [
                'name' => 'PHP 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 9,
            ],
            [
                'name' => 'PHP 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 9,
            ],
            [
                'name' => 'Laravel 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 10,
            ],
            [
                'name' => 'Laravel 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 10,
            ],
            [
                'name' => 'Laravel Basic 1',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 11,
            ],
            [
                'name' => 'Laravel Basic 2',
                'video' => 'https://www.youtube.com/watch?v=Tn6-PIqc4UM&ab_channel=Fireship',
                'chapter_id' => 11,
            ]
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
