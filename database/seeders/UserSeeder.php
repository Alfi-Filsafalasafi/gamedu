<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin Gamedu',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'prodi' => '',
            'angkatan' => '',
            'photo' => '',
        ]);
        User::create([
            'name' => 'Wahyu Nur Hidayat, S.Pd., M.Pd',
            'email' => 'dosen@gmail.com',
            'role' => 'dosen',
            'token_dosen' => 'Auy8ik',
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'prodi' => '',
            'angkatan' => '',
            'photo' => '',
        ]);
        User::create([
            'name' => 'Alfi Filsafalasafi',
            'email' => 'filsafalasafi@gmail.com',
            'role' => 'mahasiswa',
            'id_dosen' => 2,
            'password' => bcrypt('password'),
            'jenis_kelamin' => 'L',
            'prodi' => 'S1 Pendidikan Teknik Informatika',
            'angkatan' => '2020',
            'photo' => '',
        ]);
    }
}
