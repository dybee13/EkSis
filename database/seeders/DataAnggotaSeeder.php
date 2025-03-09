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
     
        $ekskuls = DB::table('ekskuls')->pluck('id');
        $nama = ['Jane', 'Seno', 'Arif'];

        foreach ($ekskuls as $ekskulId) {
            $randomNama = Arr::random($nama); // Ambil nama acak dulu

            DB::table('data_anggota_ekskul')->insert([
                [
                    'id_ekskul' => $ekskulId,
                    'name' => $randomNama, // Pakai nama yang sudah dipilih acak
                    'nis' => '1234561234562' . $ekskulId,
                    'jurusan' => 'rpl',
                    'no_hp' => '0831231231223' . $ekskulId,
                    'email' => strtolower($randomNama) . $ekskulId . '@gmail.com', // Email pakai nama acak
                    'pp' => 'null'
                ]
            ]);
        }
    }
}