<?php

namespace Database\Seeders;

// use App\Models\Ekskuls;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InformasiEkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskuls = DB::table('ekskuls')->pluck('id');

        foreach($ekskuls as $ekskulId){
        DB::table('informasi_ekskuls')->insert([
            [
                'id_ekskul' => $ekskulId,
                'tgl_berdiri' => now(),
                'logo' => 'badminton.jpg',
                'jadwal' => 'Senin, Selasa, Rabu',
                'deskripsi' => 'apa sajalah'
            ]
        ]);
        }
    }
}
