<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Nette\Utils\Random;

class StrukturEkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskuls = DB::table('ekskuls')->pluck('id');
        $anggotas = DB::table('struktur_ekskuls')->pluck('id');
        
        foreach($ekskuls as $ekskulId){
        foreach($anggotas as $anggotaId){
        DB::table('struktur_ekskuls')->insert([
            [
                'id_anggota_ekskul' => $anggotaId,
                'id_ekskul' => $ekskulId,
                'keterangan' => 'ketua_ekskul'
            ]]);
    }
}
}
}
