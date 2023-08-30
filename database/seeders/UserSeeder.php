<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nik' => '1234567890123456', // Ganti dengan NIK yang sesuai
            'nama' => 'Admin Role',
            'email' => 'admin@role',
            'telp' => '1234567890', // Ganti dengan nomor telepon yang sesuai
            'role' => 'admin',
            'password' => Hash::make('11111111')
        ]);

        DB::table('users')->insert([
            'nik' => '1234567890123457', // Ganti dengan NIK yang sesuai
            'nama' => 'User Role',
            'email' => 'user@role',
            'telp' => '0987654321', // Ganti dengan nomor telepon yang sesuai
            'role' => 'masyarakat',
            'password' => Hash::make('12345678')
        ]);

    }
}
