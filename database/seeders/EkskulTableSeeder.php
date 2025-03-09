<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EkskulTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ekskuls')->insert([
            [
                'nama_ekskul' => 'NeMo Band',
                'remember_token' => Str::random(10),
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ekskul' => 'Badminton',
                'remember_token' => Str::random(10),
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
