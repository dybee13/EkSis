<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnggotaEkskul;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();

        $this->call([
            UsersTableSeeder::class,
            EkskulTableSeeder::class,
            InformasiEkskulSeeder::class,
            DataAnggotaSeeder::class,
            StrukturEkskulSeeder::class,
            EkskulUserSeeder::class,
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
