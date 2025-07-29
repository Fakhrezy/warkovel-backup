<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first (skip if already exist)
        // $this->call(RoleSeeder::class);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin Cafe',
            'email' => 'admin@cafe.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Create karyawan data for admin
        Karyawan::create([
            'nama' => 'Admin Cafe',
            'umur' => 30,
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Admin No. 1, Jakarta',
            'posisi' => 'admin',
            'gaji' => 10000000,
            'user_id' => $admin->id
        ]);

        // Create karyawan user
        $karyawan = User::factory()->create([
            'name' => 'Karyawan Cafe',
            'email' => 'karyawan@cafe.com',
            'password' => bcrypt('password'),
        ]);
        $karyawan->assignRole('karyawan');

        // Create karyawan data for karyawan
        Karyawan::create([
            'nama' => 'Karyawan Cafe',
            'umur' => 25,
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Karyawan No. 2, Jakarta',
            'posisi' => 'karyawan',
            'gaji' => 4000000,
            'user_id' => $karyawan->id
        ]);

        // Create barista user
        $barista = User::factory()->create([
            'name' => 'Barista Cafe',
            'email' => 'barista@cafe.com',
            'password' => bcrypt('password'),
        ]);
        $barista->assignRole('barista');

        // Create karyawan data for barista
        Karyawan::create([
            'nama' => 'Barista Cafe',
            'umur' => 28,
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Barista No. 3, Jakarta',
            'posisi' => 'barista',
            'gaji' => 4500000,
            'user_id' => $barista->id
        ]);

        // Create kasir user
        $kasir = User::factory()->create([
            'name' => 'Kasir Cafe',
            'email' => 'kasir@cafe.com',
            'password' => bcrypt('password'),
        ]);
        $kasir->assignRole('kasir');

        // Create karyawan data for kasir
        Karyawan::create([
            'nama' => 'Kasir Cafe',
            'umur' => 23,
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Kasir No. 4, Jakarta',
            'posisi' => 'kasir',
            'gaji' => 3500000,
            'user_id' => $kasir->id
        ]);

        // Create test user without role
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create additional karyawan data (tanpa user_id)
        Karyawan::factory(5)->create();
    }
}
