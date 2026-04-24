<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// JANGAN LUPA IMPORT MODEL CATEGORY
use App\Models\Category; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data kategori pertama: Musik
        Category::create([
            'name' => 'Musik',
            'slug' => 'musik'
        ]);

        // Masukkan data kategori kedua: Workshop
        Category::create([
            'name' => 'Workshop',
            'slug' => 'workshop'
        ]);
    }
}