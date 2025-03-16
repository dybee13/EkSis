<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        DB::table('data_anggota_ekskul')->insert([
            [
                'id_ekskul' => '1',
                'name' => 'Muhammad Dymas Rafi', // Pakai nama yang sudah dipilih acak
                'nis' => '12228460',
                'jurusan' => 'RPL',
                'no_hp' => '083824581361',
                'email' => 'dymas@gmail.com', // Email pakai nama acak
                'pp' => 'null'
            ],
            [
                'id_ekskul' => '1',
                'name' => 'Fadil Rezky Akbar', // Pakai nama yang sudah dipilih acak
                'nis' => '222310116',
                'jurusan' => 'TKJ',
                'no_hp' => '082220592007',
                'email' => 'fadil@gmail.com', // Email pakai nama acak
                'pp' => 'null'
            ],
            [
                'id_ekskul' => '1',
                'name' => 'Haikal Rizky Umbara', // Pakai nama yang sudah dipilih acak
                'nis' => '12228461',
                'jurusan' => 'TITL',
                'no_hp' => '012345678987',
                'email' => 'haikal@gmail.com', // Email pakai nama acak
                'pp' => 'null'
            ],
            [
                'id_ekskul' => '1',
                'name' => 'Abel', // Pakai nama yang sudah dipilih acak
                'nis' => '12228462',
                'jurusan' => 'TKJ',
                'no_hp' => '098765432123',
                'email' => 'abel@gmail.com', // Email pakai nama acak
                'pp' => 'null'
            ],
            [
                'id_ekskul' => '1',
                'name' => 'Livia F', // Pakai nama yang sudah dipilih acak
                'nis' => '12228463',
                'jurusan' => 'RPL',
                'no_hp' => '056789123456',
                'email' => 'livia@gmail.com', // Email pakai nama acak
                'pp' => 'null'
            ],
        ]);
    }
}