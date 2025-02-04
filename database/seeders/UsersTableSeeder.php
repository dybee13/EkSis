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
                'email' => 'master@mail.com',
                'no_hp' => '081234567890',
                'nip' => null,
                'nis' => null,
                'kelas' => null,
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
                'email' => 'pembina@mail.com',
                'no_hp' => '081234567891',
                'nip' => '123456789',
                'nis' => null,
                'kelas' => null,
                'jurusan' => null,
                'pp' => 'profile.png',
                'role' => 'pembina',
                'email_verified_at' => now(),
                'password' => Hash::make('pembina123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Dymas Rafi',
                'email' => 'pengurus@mail.com',
                'no_hp' => '081234567892',
                'nip' => null,
                'nis' => '987654321',
                'kelas' => '12',
                'jurusan' => 'RPL',
                'pp' => 'profile.png',
                'role' => 'pengurus',
                'email_verified_at' => now(),
                'password' => Hash::make('pengurus123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
