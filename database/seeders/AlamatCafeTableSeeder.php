<?php

namespace Database\Seeders;

use App\Models\AlamatCafe;
use Illuminate\Database\Seeder;

class AlamatCafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alamatCafes = [
            [
                'cafe_id' => 1,
                'village' => 'Kelet',
                'city' => 'Jepara',
                'provinsi' => 'Jawa Tengah',
                'url_maps' => 'https://maps.app.goo.gl/PmSpE6hF26McLVhi7',
            ],
            [
                'cafe_id' => 2,
                'village' => 'Kelet',
                'city' => 'Jepara',
                'provinsi' => 'Jawa Tengah',
                'url_maps' => 'https://maps.app.goo.gl/zJBNmjQVABZJGBCQ9', // Ganti dengan URL Maps asli
            ],
            [
                'cafe_id' => 3,
                'village' => 'Bangsri',
                'city' => 'Jepara',
                'provinsi' => 'Jawa Tengah',
                'url_maps' => 'https://maps.app.goo.gl/ABC987654321', // Ganti dengan URL Maps asli
            ],
            [
                'cafe_id' => 4,
                'village' => 'Tahunan',
                'city' => 'Jepara',
                'provinsi' => 'Jawa Tengah',
                'url_maps' => 'https://maps.app.goo.gl/LMN567890123', // Ganti dengan URL Maps asli
            ],
        ];

        foreach ($alamatCafes as $data) {
            AlamatCafe::create($data); // Menggunakan create() agar otomatis menangani timestamps
        }
    }
}
