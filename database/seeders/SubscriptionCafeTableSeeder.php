<?php

namespace Database\Seeders;

use App\Models\Cafe\SubscriptionCafe;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionCafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptionCafes = [
            [
                'cafe_id' => 1,
                'user_id' => 2,
                'is_premium' => false,
                'request_date' => Carbon::now(),
                'price' => 0,
            ],
        ];

        SubscriptionCafe::insert($subscriptionCafes);
    }
}
