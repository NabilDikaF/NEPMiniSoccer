<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            // 1. Akun Admin
            [
                'name' => 'Super Admin',
                'email' => 'admin@minisoccer.com',
                'no_hp' => null,
                'password' => Hash::make('rahasia123'), // Hash::make berfungsi untuk mengenkripsi password
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2. Akun Pelanggan Dummy
            [
                'name' => 'Budi Pelanggan',
                'email' => 'budi@gmail.com',
                'no_hp' => '08123456789',
                'password' => Hash::make('pelanggan123'),
                'role' => 'pelanggan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}