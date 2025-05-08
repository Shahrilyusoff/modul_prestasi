<?php

// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'jawatan' => 'Pembangun Sistem',
            'gred' => 'IT',
            'jabatan' => 'ICT',
            'no_kp' => '000000-00-0000'
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jawatan' => 'Pegawai HR',
            'gred' => 'N41',
            'jabatan' => 'Sumber Manusia',
            'no_kp' => '111111-11-1111'
        ]);

        // PPP
        User::create([
            'name' => 'PPP Contoh',
            'email' => 'ppp@example.com',
            'password' => Hash::make('password'),
            'role' => 'ppp',
            'jawatan' => 'Ketua Jabatan',
            'gred' => 'N44',
            'jabatan' => 'Akademik',
            'no_kp' => '222222-22-2222'
        ]);

        // PPK
        User::create([
            'name' => 'PPK Contoh',
            'email' => 'ppk@example.com',
            'password' => Hash::make('password'),
            'role' => 'ppk',
            'jawatan' => 'Pengarah',
            'gred' => 'N48',
            'jabatan' => 'Akademik',
            'no_kp' => '333333-33-3333'
        ]);

        // PYD - Management
        User::create([
            'name' => 'PYD Kumpulan Pengurusan Dan Profesional',
            'email' => 'pengurusan@example.com',
            'password' => Hash::make('password'),
            'role' => 'pyd',
            'jenis' => 'pengurusan',
            'jawatan' => 'Pegawai Akademik',
            'gred' => 'N41',
            'jabatan' => 'Akademik',
            'no_kp' => '444444-44-4444'
        ]);

        // PYD - Sokongan I
        User::create([
            'name' => 'PYD Kumpulan Perkhidmatan Sokongan I',
            'email' => 'sokongani@example.com',
            'password' => Hash::make('password'),
            'role' => 'pyd',
            'jenis' => 'sokongan_i',
            'jawatan' => 'Pembantu Tadbir',
            'gred' => 'N27',
            'jabatan' => 'Pentadbiran',
            'no_kp' => '555555-55-5555'
        ]);

        // PYD - Sokongan II
        User::create([
            'name' => 'PYD Kumpulan Perkhidmatan Sokongan II',
            'email' => 'sokonganii@example.com',
            'password' => Hash::make('password'),
            'role' => 'pyd',
            'jenis' => 'sokongan_ii',
            'jawatan' => 'Pembantu Am Pejabat',
            'gred' => 'N17',
            'jabatan' => 'Pentadbiran',
            'no_kp' => '666666-66-6666'
        ]);
    }
}
