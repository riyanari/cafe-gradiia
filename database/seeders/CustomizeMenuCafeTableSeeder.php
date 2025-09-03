<?php

namespace Database\Seeders;

use App\Models\CustomizeMenuCafe;
use Illuminate\Database\Seeder;

class CustomizeMenuCafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customizeMenuCafes = [
            // Menu untuk MenuCafe ID 3
            [
                'menu_cafe_id' => 3,
                'name' => 'Sate Daging',
                'price_sub' => 2000,
                'is_selected' => false, // Gunakan snake_case
                'is_available' => true, 
            ],
            [
                'menu_cafe_id' => 3,
                'name' => 'Sate Usus',
                'price_sub' => 2000,
                'is_selected' => false, // Gunakan snake_case
                'is_available' => true, 
            ],
            // Tambahkan lebih banyak data jika diperlukan
        ];

        // Gunakan insert() untuk lebih cepat
        CustomizeMenuCafe::insert($customizeMenuCafes);
    }
}
