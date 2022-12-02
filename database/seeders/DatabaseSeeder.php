<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
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
        Kategori::create([
            'namaKategori' => 'Kesehatan',
            'descKategori' => 'Untuk kesehatan',
        ]);
        Kategori::create([
            'namaKategori' => 'Batuk-Batuk',
            'descKategori' => 'Untuk batuk',
        ]);
        Kategori::create([
            'namaKategori' => 'Pegal',
            'descKategori' => 'Untuk pegal',
        ]);
        Kategori::create([
            'namaKategori' => 'Hipertensi',
            'descKategori' => 'Untuk hipertensi',
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
