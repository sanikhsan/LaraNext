<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chapters = [
            [
                'name' => 'Mengenal Javascript',
                'course_id' => 1
            ],
            [
                'name' => 'Mengenal React',
                'course_id' => 1
            ],
            [
                'name' => 'Basic React',
                'course_id' => 1
            ],
            [
                'name' => 'Mengenal Golang',
                'course_id' => 2
            ],
            [
                'name' => 'Basic Golang',
                'course_id' => 2
            ],
            [
                'name' => 'Mengenal Dart',
                'course_id' => 3
            ],
            [
                'name' => 'Mengenal Flutter',
                'course_id' => 3
            ],
            [
                'name' => 'Basic Flutter',
                'course_id' => 3
            ],
            [
                'name' => 'Mengenal PHP',
                'course_id' => 4
            ],
            [
                'name' => 'Mengenal Laravel',
                'course_id' => 4
            ],
            [
                'name' => 'Basic Laravel',
                'course_id' => 4
            ],
        ];

        foreach ($chapters as $chapter) {
            Chapter::create($chapter);
        }
    }
}
