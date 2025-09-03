<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@cafemyu.test',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('superadmin');

        $pemilikCafe = User::create([
            'name' => 'Rolet',
            'email' => 'rolet@cafemyu.test',
            'password' => bcrypt('12345678'),
        ]);

        $pemilikCafe->assignRole('admin');
    }
}
