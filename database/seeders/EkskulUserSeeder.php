<?php

namespace Database\Seeders;

use App\Models\Ekskuls;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EkskulUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan ada data di tabel users dan ekskuls
        if (User::count() === 0 || Ekskuls::count() === 0) {
            $this->command->info('Tabel users atau ekskuls kosong, tidak ada data yang dimasukkan.');
            return;
        }

        // Loop untuk memasukkan data secara acak
        $data = [];
        for ($i = 0; $i < 3; $i++) {
            $data[] = [
                'id_user' => User::inRandomOrder()->value('id'),
                'id_ekskul' => Ekskuls::inRandomOrder()->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert batch
        DB::table('ekskul_users')->insert($data);

        $this->command->info('Berhasil menambahkan 3 data ke tabel ekskul_users.');
    }
}
