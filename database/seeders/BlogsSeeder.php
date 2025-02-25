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
        DB::table('blogs')->insert([
            [
                'title' => 'Job Fair NeMo',
                'slug' => 'job-fair',
                'body' => 'Mengisi acara JOB FAIR yang di adakan sekolah',
                'keterangan' => 'activities',
                'id_ekskul' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('blog_images')->insert([
            [
                'blog_id' => '1',
                'image_path' => 'nemo_blogs.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
