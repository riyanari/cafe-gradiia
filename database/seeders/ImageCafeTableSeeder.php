<?php

namespace Database\Seeders;

use App\Models\ImageCafe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageCafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageCafes = [
            [
                'cafe_id' => 1,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1661875793803-92f4c8b6ae84?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y2FmZSUyMGludGVyaW9yfGVufDB8fDB8fHww',
            ],
            [
                'cafe_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1494346480775-936a9f0d0877?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Y2FmZSUyMGludGVyaW9yfGVufDB8fDB8fHww',
            ],
            [
                'cafe_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1613274554329-70f997f5789f?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FmZSUyMGludGVyaW9yfGVufDB8fDB8fHww',
            ],

            // Cafe 2
            [
                'cafe_id' => 2,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1663932464735-e0946d833749?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y2FmZSUyMGludGVyaW9yfGVufDB8fDB8fHww',
            ],
            [
                'cafe_id' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1612192527395-06b72da6b35a?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8Y2FmZSUyMGludGVyaW9yfGVufDB8fDB8fHww',
            ],

            // Cafe 3
            [
                'cafe_id' => 3,
                'image_url' => 'https://images.unsplash.com/photo-1578231177134-f1bbe379b054?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNhZmUlMjBpbnRlcmlvcnxlbnwwfHwwfHx8MA%3D%3D',
            ],
            [
                'cafe_id' => 3,
                'image_url' => 'https://images.unsplash.com/photo-1442975631115-c4f7b05b8a2c?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGNhZmUlMjBpbnRlcmlvcnxlbnwwfHwwfHx8MA%3D%3D',
            ],

            // Cafe 4
            [
                'cafe_id' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1726873800099-53f5496281e0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fGNhZmUlMjBpbnRlcmlvcnxlbnwwfHwwfHx8MA%3D%3D',
            ],
            [
                'cafe_id' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1648462908676-8305f0eff8e0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGNhZmUlMjBpbnRlcmlvcnxlbnwwfHwwfHx8MA%3D%3D',
            ],
        ];

        // Insert data ke dalam database menggunakan create()
        foreach ($imageCafes as $data) {
            ImageCafe::create($data);
        }
    }
}
