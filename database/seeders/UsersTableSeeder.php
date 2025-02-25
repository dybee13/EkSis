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
                'name' => 'Pembina',
                'email' => 'pembina@gmail.com',
                'no_hp' => '081231231232',
                'nip' => '111111111111111111',
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
                'name' => 'Pengurus',
                'email' => 'pengurus@gmail.com',
                'no_hp' => '081231231332',
                'nip' => null,
                'nis' => '22222222',
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
