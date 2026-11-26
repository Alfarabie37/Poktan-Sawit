<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KelompokTani;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@poktansawit.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role'     => 'super_admin',
                'status'   => 'aktif',
            ]
        );

        // Akun Contoh Pengurus Kelompok Tani
        $pengurus = User::updateOrCreate(
            ['email' => 'pengurus@poktansawit.com'],
            [
                'name'     => 'Nama Pengurus',
                'password' => Hash::make('pengurus123'),
                'role'     => 'pengurus',
                'status'   => 'aktif',
            ]
        );

        KelompokTani::updateOrCreate(
            ['user_id' => $pengurus->id],
            [
                'nama_kelompok'      => 'Tani Makmur Sawit',
                'desa'               => 'Sedinginan',
                'kecamatan'          => 'Tanah Putih',
                'nama_ketua'         => 'M. LC Alfarabie',
                'tahun_berdiri'      => 2019,
                'no_hp'              => '081234567890',
                'alamat_sekretariat' => 'Jl. Lintas Riau - Sumut, Sedinginan',
                'status_verifikasi'  => 'disetujui',
            ]
        );
    }
}
