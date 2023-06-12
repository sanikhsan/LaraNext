<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin LaraNext',
                'profession' => 'Administrator',
                'role' => 'admin',
                'email' => 'admin@laranext.dev',
                'password' => Hash::make('admin@laranext.dev'),
                'email_verified_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Student LaraNext',
                'profession' => 'Student',
                'role' => 'student',
                'email' => 'student@laranext.dev',
                'password' => Hash::make('student@laranext.dev'),
                'email_verified_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
