<?php

namespace Database\Seeders;

use App\Models\Cafe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cafes = [
            [
                'name' => 'Rolet',
                'slug' => 'rolet',
                'place_type' => 'cafe',
                'open' => '08:00',
                'close' => '22:00',
                'rating' => 4.3,
                'tables_num' => 20,
                'is_takeaway' => 1,
                'logo_cafe' => 'https://m.media-amazon.com/images/M/MV5BMDFkYTc0MGEtZmNhMC00ZDIzLWFmNTEtODM1ZmRlYWMwMWFmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg',
            ],
            [
                'name' => 'Rolet Specta',
                'slug' => 'rolet-specta',
                'place_type' => 'cafe',
                'open' => '07:00',
                'close' => '22:00',
                'rating' => 4.8,
                'tables_num' => 15,
                'is_takeaway' => 1,
                'logo_cafe' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7zJTeIh-XLNcpvJL2BR3k-x52FapTKWZJwA&s',
            ],
            [
                'name' => 'Resto Padang',
                'slug' => 'resto-padang',
                'place_type' => 'resto',
                'open' => '10:00',
                'close' => '20:00',
                'rating' => 4.2,
                'tables_num' => 30,
                'is_takeaway' => 1,
                'logo_cafe' => 'https://example.com/logo-resto-padang.jpg',
            ],
            [
                'name' => 'Cafe & Resto 99',
                'slug' => 'cafe-resto-99',
                'place_type' => 'cafe & resto',
                'open' => '09:00',
                'close' => '23:00',
                'rating' => 4.0,
                'tables_num' => 25,
                'is_takeaway' => 1,
                'logo_cafe' => 'https://example.com/logo-cafe-resto-99.jpg',
            ],
        ];
        
        // Insert data ke tabel cafes
        Cafe::insert($cafes);
    }
}
