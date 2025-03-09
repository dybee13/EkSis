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
        //         'title' => 'Memenangkan Kejuaraan Provinsi Badminton Putra',
        //         'slug' => 'memenangkan-kejuaraan-provinsi-badminton-putra',
        //         'body' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
        //         'keterangan' => 'achievments',
        //         'id_ekskul' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Latihan Rutin Badminton',
        //         'slug' => 'latihan-rutin-badminton',
        //         'body' => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
        //         'keterangan' => 'activities',
        //         'id_ekskul' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Kejuaraan Lomba Badminton Ganda Putra-Putri',
        //         'slug' => 'kejuaraan-lomba-badminton-ganda-putra-putri',
        //         'body' => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
        //         'keterangan' => 'activities',
        //         'id_ekskul' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Latihan Rutin bersama SMKN 1 Kedawung',
        //         'slug' => 'latihan-rutin-bersama-smkn-1-kedawung',
        //         'body' => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
        //         'keterangan' => 'activities',
        //         'id_ekskul' => '2',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        DB::table('blog_images')->insert([
            [
                'blog_id' => '10',
                'image_path' => 'badmin_achi.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => '11',
                'image_path' => 'badmin_acti.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => '12',
                'image_path' => 'badmin_achi2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => '13',
                'image_path' => 'badmin_acti2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
