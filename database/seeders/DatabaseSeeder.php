<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CafeTableSeeder::class);
        $this->call(AlamatCafeTableSeeder::class);
        $this->call(ImageCafeTableSeeder::class);
        $this->call(MenuCafeTableSeeder::class);
        $this->call(CustomizeMenuCafeTableSeeder::class);
        $this->call(QrTableTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
        $this->call(TransactionMenuTableSeeder::class);
        $this->call(SubscriptionCafeTableSeeder::class);
    }
}
