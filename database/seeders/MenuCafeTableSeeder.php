<?php

namespace Database\Seeders;

use App\Models\MenuCafe;
use Illuminate\Database\Seeder;

class MenuCafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuCafes = [
            // Menu Cafe 1
            [
                'cafe_id' => 1,
                'name' => 'Mie Ayam Jamur',
                'category' => 'Mie',
                'price' => 13000,
                'img_menu' => 'https://example.com/images/mie-ayam-jamur.jpg',
                'isAvailable' => false,
                'isCustomizable' => false,
                'isRecommended' => true,
            ],
            [
                'cafe_id' => 1,
                'name' => 'Es Teh Manis',
                'category' => 'Minuman',
                'price' => 5000,
                'img_menu' => 'https://example.com/images/es-teh-manis.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => false,
            ],

            // Menu Cafe 2
            [
                'cafe_id' => 2,
                'name' => 'Nasi Goreng Special',
                'category' => 'Nasi',
                'price' => 18000,
                'img_menu' => 'https://example.com/images/nasi-goreng-special.jpg',
                'isAvailable' => true,
                'isCustomizable' => true,
                'isRecommended' => true,
            ],
            [
                'cafe_id' => 2,
                'name' => 'Kopi Susu Gula Aren',
                'category' => 'Minuman',
                'price' => 12000,
                'img_menu' => 'https://example.com/images/kopi-susu-gula-aren.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => true,
            ],

            // Menu Cafe 3
            [
                'cafe_id' => 3,
                'name' => 'Ayam Geprek Sambal Bawang',
                'category' => 'Ayam',
                'price' => 20000,
                'img_menu' => 'https://example.com/images/ayam-geprek.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => true,
            ],
            [
                'cafe_id' => 3,
                'name' => 'Jus Alpukat',
                'category' => 'Minuman',
                'price' => 10000,
                'img_menu' => 'https://example.com/images/jus-alpukat.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => false,
            ],

            // Menu Cafe 4
            [
                'cafe_id' => 4,
                'name' => 'Pisang Goreng Coklat Keju',
                'category' => 'Snack',
                'price' => 12000,
                'img_menu' => 'https://example.com/images/pisang-goreng-coklat-keju.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => true,
            ],
            [
                'cafe_id' => 4,
                'name' => 'Milkshake Coklat',
                'category' => 'Minuman',
                'price' => 15000,
                'img_menu' => 'https://example.com/images/milkshake-coklat.jpg',
                'isAvailable' => true,
                'isCustomizable' => false,
                'isRecommended' => false,
            ],
        ];

        // Insert data ke dalam database menggunakan create()
        foreach ($menuCafes as $data) {
            MenuCafe::create($data);
        }
    }
}
