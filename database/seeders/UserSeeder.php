<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Admin Kopi',
            'email' => 'admin@pasarkopi.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password aman Anda
            'role' => 'admin',
        ]);

        // Membuat Akun Pengunjung Biasa
        User::create([
            'name' => 'Budi Pengunjung',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pengunjung',
        ]);
    }
}