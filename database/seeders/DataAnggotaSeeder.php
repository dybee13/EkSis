<?php

namespace Database\Seeders;

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

        foreach($ekskuls as $ekskulId){
        DB::table('data_anggota_ekskul')->insert([
            [
                'id_ekskul' => $ekskulId,
                'name' => 'Jane',
                'nis' => '123456123456'.$ekskulId,
                'jurusan' => 'rpl',
                'no_hp' => '083123123123'.$ekskulId,
                'email' => 'jane'.$ekskulId.'@gmail.com',
                'pp' => 'null'
            ]
            ]);
        }
    }
}
