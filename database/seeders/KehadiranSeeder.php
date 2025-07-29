<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kehadiran;
use App\Models\Karyawan;
use Carbon\Carbon;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data karyawan
        $karyawans = Karyawan::all();

        if ($karyawans->isEmpty()) {
            $this->command->info('No employees found. Please seed employees first.');
            return;
        }

        $statusOptions = ['hadir', 'tidak_hadir', 'izin', 'sakit'];
        $startDate = Carbon::now()->subDays(30); // 30 hari yang lalu
        $endDate = Carbon::now();

        $this->command->info('Creating attendance records...');

        foreach ($karyawans as $karyawan) {
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                // Skip weekend (optional)
                if ($currentDate->isWeekend()) {
                    $currentDate->addDay();
                    continue;
                }

                // Random chance of attendance (90% chance of having a record)
                if (rand(1, 100) <= 90) {
                    $status = $statusOptions[array_rand($statusOptions)];

                    // Weighted probability for status
                    $rand = rand(1, 100);
                    if ($rand <= 75) {
                        $status = 'hadir';
                    } elseif ($rand <= 85) {
                        $status = 'izin';
                    } elseif ($rand <= 92) {
                        $status = 'sakit';
                    } else {
                        $status = 'tidak_hadir';
                    }

                    $jamMasuk = null;
                    $jamKeluar = null;
                    $keterangan = null;

                    // Set jam masuk dan keluar berdasarkan status
                    if ($status === 'hadir') {
                        $jamMasuk = $currentDate->copy()->setTime(8, rand(0, 30)); // 08:00 - 08:30
                        $jamKeluar = $currentDate->copy()->setTime(17, rand(0, 30)); // 17:00 - 17:30
                    } elseif ($status === 'izin') {
                        $keterangan = 'Izin keperluan keluarga';
                    } elseif ($status === 'sakit') {
                        $keterangan = 'Sakit demam';
                    } elseif ($status === 'tidak_hadir') {
                        $keterangan = 'Tidak ada kabar';
                    }

                    // Create attendance record
                    Kehadiran::create([
                        'karyawan_id' => $karyawan->id,
                        'tanggal' => $currentDate->format('Y-m-d'),
                        'jam_masuk' => $jamMasuk ? $jamMasuk->format('H:i:s') : null,
                        'jam_keluar' => $jamKeluar ? $jamKeluar->format('H:i:s') : null,
                        'status_kehadiran' => $status,
                        'keterangan' => $keterangan,
                    ]);
                }

                $currentDate->addDay();
            }
        }

        $this->command->info('Attendance records created successfully!');
    }
}
