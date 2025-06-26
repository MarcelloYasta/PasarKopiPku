<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil semua seeder yang kita butuhkan secara berurutan.
        $this->call([
            UserSeeder::class,
            CategorySeeder::class, // <-- [SESUAIKAN] Menambahkan seeder untuk kategori
        ]);
    }
}
