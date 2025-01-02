<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test@example.com'), // Pastikan kata sandi di-hash
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'Nasional'
        ]);

        DB::table('berita')->insert([
            'Judul_berita' => 'lorem ipsum',
            'isi_berita' => 'lorem ipsum',
            'gambar_berita' => 'sepatu.png',
            'id_kategori' => 1
        ]);

        DB::table('page')->insert([
            'Judul_page' => 'lorem ipsum',
            'isi_page' => 'lorem ipsum',
            'status_page' => 1
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'lorem',
            'jenis_menu' => 'page',
            'url_menu' => '1',
            'target_menu' => '_blank',
            'urutan_menu' => 1,
            'parent_menu' => null,
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'google',
            'jenis_menu' => 'url',
            'url_menu' => 'https://www.google.com',
            'target_menu' => '_blank',
            'urutan_menu' => 2,
            'parent_menu' => null,
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'Cloud Storage',
            'jenis_menu' => 'url',
            'url_menu' => '#',
            'target_menu' => '_self',
            'urutan_menu' => 3,
            'parent_menu' => null,
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'GCP',
            'jenis_menu' => 'url',
            'url_menu' => 'https://cloud.google.com',
            'target_menu' => '_self',
            'urutan_menu' => 1,
            'parent_menu' => 3, // Parent ID mengacu pada "Cloud Storage"
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'AWS',
            'jenis_menu' => 'url',
            'url_menu' => 'https://aws.amazon.com',
            'target_menu' => '_self',
            'urutan_menu' => 2,
            'parent_menu' => 3, // Parent ID mengacu pada "Cloud Storage"
        ]);

    }
}
