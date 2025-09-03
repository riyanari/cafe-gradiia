<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['superadmin', 'owner_cafe', 'admin_cafe', 'cashier_cafe'];

        // Hapus role yang tidak ada dalam daftar baru
        Role::whereNotIn('name', $roles)->delete();

        // Tambah role baru jika belum ada
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
