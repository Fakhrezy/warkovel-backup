<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class LinkUserKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua karyawan yang belum memiliki user_id
        $karyawanTanpaUser = Karyawan::whereNull('user_id')->get();

        foreach ($karyawanTanpaUser as $karyawan) {
            // Buat user baru untuk karyawan
            $user = User::create([
                'name' => $karyawan->nama,
                'email' => strtolower(str_replace(' ', '.', $karyawan->nama)) . '@cafe.com',
                'password' => Hash::make('password123'), // Password default
                'email_verified_at' => now(),
            ]);

            // Assign role karyawan
            $user->assignRole('karyawan');

            // Update karyawan dengan user_id
            $karyawan->update(['user_id' => $user->id]);

            $this->command->info("Berhasil membuat user untuk karyawan: {$karyawan->nama} (email: {$user->email})");
        }

        // Jika tidak ada karyawan, buat contoh data
        if ($karyawanTanpaUser->isEmpty()) {
            $this->createSampleData();
        }
    }

    private function createSampleData()
    {
        // Buat user karyawan contoh
        $userKaryawan = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@cafe.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        $userKaryawan->assignRole('karyawan');

        // Buat data karyawan
        $karyawan = Karyawan::create([
            'user_id' => $userKaryawan->id,
            'nama' => 'John Doe',
            'alamat' => 'Jl. Contoh No. 123',
            'telepon' => '081234567890',
            'jabatan' => 'Barista',
            'gaji' => 3000000,
        ]);

        $this->command->info("Berhasil membuat contoh karyawan: {$karyawan->nama} (email: {$userKaryawan->email})");
    }
}
