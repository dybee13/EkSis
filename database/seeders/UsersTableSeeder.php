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
                'name' => 'Admin Master',
                'email' => 'master@gmail.com',
                'no_hp' => '08123123123',
                'nip' => null,
                'nis' => null,
                'jurusan' => null,
                'pp' => 'profile.png',
                'role' => 'master',
                'email_verified_at' => now(),
                'password' => Hash::make('master123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembina',
                'email' => 'pembina@gmail.com',
                'no_hp' => '081231231231',
                'nip' => null,
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
                'name' => 'User',
                'email' => 'user@gmail.com',
                'no_hp' => '081231231232',
                'nip' => null,
                'nis' => null,
                'jurusan' => null,
                'pp' => 'profile.png',
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('user123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
