<?php

namespace Database\Seeders;

use App\Models\Cafe\QrTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QrTableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qrTables = [
            [
                'cafe_id' => 1,
                'link_url' => 'http://127.0.0.1:8000/Cafe/cafe-rolet-kelet-1',
                'no_table' => 1, // Mengubah no_table menjadi no_table
                'is_reserved' => false,
            ],
            [
                'cafe_id' => 1,
                'link_url' => 'http://127.0.0.1:8000/Cafe/cafe-rolet-kelet-1',
                'no_table' => 2,
                'is_reserved' => true,

            ],
            [
                'cafe_id' => 2,
                'link_url' => 'http://127.0.0.1:8000/Cafe/cafe-rolet-kelet-1',
                'no_table' => 3,
                'is_reserved' => false,
            ],
        ];

        // Insert data ke dalam database menggunakan create()
        foreach ($qrTables as $data) {
            QrTable::create($data);
        }
    }
}
