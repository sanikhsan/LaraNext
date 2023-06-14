<?php

namespace Database\Seeders;

use App\Models\CourseImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'course_id' => 1,
                'image' => 'https://blog.fellyph.com.br/wp-content/uploads/2016/06/react-js.png'
            ],
            [
                'course_id' => 1,
                'image' => 'https://blog.fellyph.com.br/wp-content/uploads/2016/06/react-js.png'
            ],
            [
                'course_id' => 2,
                'image' => 'https://miro.medium.com/v2/resize:fit:1400/1*Ifpd_HtDiK9u6h68SZgNuA.png'
            ],
            [
                'course_id' => 2,
                'image' => 'https://miro.medium.com/v2/resize:fit:1400/1*Ifpd_HtDiK9u6h68SZgNuA.png'
            ],
            [
                'course_id' => 3,
                'image' => 'https://global-uploads.webflow.com/6100d0111a4ed76bc1b9fd54/62ba7b7f547a660f37c11826_flutter%201.png'
            ],
            [
                'course_id' => 3,
                'image' => 'https://global-uploads.webflow.com/6100d0111a4ed76bc1b9fd54/62ba7b7f547a660f37c11826_flutter%201.png'
            ],
            [
                'course_id' => 4,
                'image' => 'https://logique.s3.ap-southeast-1.amazonaws.com/2020/10/laravel-8.jpg'
            ],
            [
                'course_id' => 4,
                'image' => 'https://logique.s3.ap-southeast-1.amazonaws.com/2020/10/laravel-8.jpg'
            ]
        ];

        foreach ($images as $image) {
            CourseImage::create($image);
        }
    }
}
