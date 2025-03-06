<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('blogs')->insert([
        //     [
        //         'title' => 'Memenangkan Kejuaraan Provinsi',
        //         'slug' => 'memenangkan-kejuaraan-provinsi',
        //         'body' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
        //         'keterangan' => 'achievments',
        //         'id_ekskul' => '1',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Acara HUT NEPER',
        //         'slug' => 'acara-hut-neper',
        //         'body' => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
        //         'keterangan' => 'activities',
        //         'id_ekskul' => '1',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        DB::table('blog_images')->insert([
            [
                'blog_id' => '4',
                'image_path' => 'nemo_achi.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => '5',
                'image_path' => 'nemo_acti2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
