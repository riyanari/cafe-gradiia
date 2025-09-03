<?php

namespace Database\Seeders;

use App\Models\Cafe\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'qr_table_id' => 1,
                'invoice' => 'INV-001',
                'date' => '2023-10-01',
                'name' => 'John Doe',
                'phone_customer' => '081234567890',
                'price_amount' => 150000.00,
                'is_takeaway' => false,
                'status' => true,
            ],
        ];

        // Insert data ke dalam database menggunakan create()
        foreach ($transactions as $data) {
            Transaction::create($data);
        }
    }
}
