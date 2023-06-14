<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentors = [
            [
                'name' => 'React Dev',
                'profile' => 'React Senior Developer di Facebook',
                'email' => 'react@laranext.dev',
                'profession' => 'Senior Front End'
            ],
            [
                'name' => 'Golang Dev',
                'profile' => 'Golang Developer di Google',
                'email' => 'golang@laranext.dev',
                'profession' => 'Senior Back End'
            ],
            [
                'name' => 'Flutter Dev',
                'profile' => 'Flutter Senior Developer di Amazon',
                'email' => 'flutter@laranext.dev',
                'profession' => 'Senior Mobile Developer'
            ],
            [
                'name' => 'Laravel Dev',
                'profile' => 'Laravel Developer di Laracast',
                'email' => 'laravel@laranext.dev',
                'profession' => 'Senior Back End'
            ]
        ];

        foreach ($mentors as $mentor) {
            Mentor::create($mentor);
        }
    }
}
