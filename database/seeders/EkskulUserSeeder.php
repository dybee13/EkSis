<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EkskulUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('ekskul_users')->insert([
            ['id_user' => 2, 'id_ekskul' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_user' => 3, 'id_ekskul' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_user' => 3, 'id_ekskul' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
