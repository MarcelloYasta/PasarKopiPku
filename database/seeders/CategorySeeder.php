<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // <-- Jangan lupa import Model Category
use Illuminate\Support\Str; // <-- Import Str untuk membuat slug

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Beans',
            'Fresh Milk',
            'Palm Sugar',
            'Powder',
            'Syrup',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), // Membuat versi URL-friendly, contoh: 'Palm Sugar' -> 'palm-sugar'
            ]);
        }
    }
}