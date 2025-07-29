<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;

class UpdateUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating user roles...');

        // Set admin role for existing admin users
        $adminUsers = User::role('admin')->get();
        foreach ($adminUsers as $user) {
            $user->update(['role' => 'admin']);
            $this->command->info("Updated {$user->name} to admin role");
        }

        // Set staff role for specific karyawan (deden, mimin, neneng, dadang, lilis)
        $staffKaryawan = ['Deden', 'Mimin', 'Neneng', 'Dadang', 'Lilis'];

        foreach ($staffKaryawan as $namaKaryawan) {
            $karyawan = Karyawan::where('nama', $namaKaryawan)->first();
            if ($karyawan && $karyawan->user) {
                $karyawan->user->update(['role' => 'staff']);
                $this->command->info("Updated {$karyawan->user->name} (karyawan: {$namaKaryawan}) to staff role");
            }
        }

        // Set role based on karyawan position for other employees
        $otherKaryawan = Karyawan::whereNotIn('nama', $staffKaryawan)->get();
        foreach ($otherKaryawan as $karyawan) {
            if ($karyawan->user) {
                $role = 'staff'; // default

                // Map karyawan position to user role
                if (stripos($karyawan->posisi ?? '', 'kasir') !== false) {
                    $role = 'kasir';
                } elseif (stripos($karyawan->posisi ?? '', 'barista') !== false) {
                    $role = 'barista';
                }

                $karyawan->user->update(['role' => $role]);
                $this->command->info("Updated {$karyawan->user->name} (posisi: {$karyawan->posisi}) to {$role} role");
            }
        }

        $this->command->info('User roles updated successfully!');
    }
}
