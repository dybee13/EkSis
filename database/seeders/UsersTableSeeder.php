<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Pembina2',
                'email' => 'pembina2@gmail.com',
                'no_hp' => '081231231233',
                'nip' => '111111111111111112',
                'nis' => null,
                'jurusan' => null,
                'pp' => 'profile.png',
                'role' => 'pembina',
                'email_verified_at' => now(),
                'password' => Hash::make('pembina123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name' => 'Pengurus2',
                'email' => 'pengurus2@gmail.com',
                'no_hp' => '081231231333',
                'nip' => null,
                'nis' => '22222223',
                'jurusan' => null,
                'pp' => 'profile.png',
                'role' => 'pengurus',
                'email_verified_at' => now(),
                'password' => Hash::make('pengurus123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
