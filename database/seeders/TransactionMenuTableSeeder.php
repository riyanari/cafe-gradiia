<?php

namespace Database\Seeders;

use App\Models\Cafe\TransactionMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionMenus = [
            [
                'menu_cafe_id' => 1,
                'transaction_id' => 1,
                'quantity' => 2,
                'total_price' => 30000,
            ],
        ];

        // Insert data ke dalam database menggunakan create()
        foreach ($transactionMenus as $data) {
            TransactionMenu::create($data);
        }
    }
}
