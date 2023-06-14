<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Kelas React Dasar',
                'certificate' => 1,
                'thumbnail' => '',
                'type' => 'FREE',
                'status' => 'Published',
                'price' => 0,
                'level' => 'Beginner',
                'description' => 'Belajar Front End dengan library ReactJS',
                'mentor_id' => 1
            ],
            [
                'name' => 'Kelas Golang Dasar',
                'certificate' => 1,
                'thumbnail' => '',
                'type' => 'FREE',
                'status' => 'Published',
                'price' => 0,
                'level' => 'Beginner',
                'description' => 'Belajar Back End menggunakan bahasa pemrograman Golang',
                'mentor_id' => 2
            ],
            [
                'name' => 'Kelas Flutter Dasar',
                'certificate' => 1,
                'thumbnail' => '',
                'type' => 'FREE',
                'status' => 'Published',
                'price' => 0,
                'level' => 'Beginner',
                'description' => 'Belajar Front End Mobile dengan framework Flutter',
                'mentor_id' => 3
            ],
            [
                'name' => 'Kelas Laravel Dasar',
                'certificate' => 1,
                'thumbnail' => '',
                'type' => 'FREE',
                'status' => 'Published',
                'price' => 0,
                'level' => 'Beginner',
                'description' => 'Belajar Back End atau Full Stack menggunakan framework Laravel',
                'mentor_id' => 4
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
