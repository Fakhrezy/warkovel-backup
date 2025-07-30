<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gaji;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gajiData = [
            [
                'posisi' => 'admin',
                'gaji_pokok' => 8000000,
                'tunjangan' => 1500000,
                'bonus' => 500000,
                'deskripsi' => 'Mengelola operasional cafe secara keseluruhan, supervisi karyawan, dan pelaporan',
                'is_active' => true
            ],
            [
                'posisi' => 'kasir',
                'gaji_pokok' => 4500000,
                'tunjangan' => 500000,
                'bonus' => 300000,
                'deskripsi' => 'Melayani transaksi penjualan, mengelola POS system, dan customer service',
                'is_active' => true
            ],
            [
                'posisi' => 'barista',
                'gaji_pokok' => 5000000,
                'tunjangan' => 750000,
                'bonus' => 400000,
                'deskripsi' => 'Membuat dan menyajikan minuman kopi, mengelola antrian pesanan',
                'is_active' => true
            ],
            [
                'posisi' => 'karyawan',
                'gaji_pokok' => 3500000,
                'tunjangan' => 300000,
                'bonus' => 200000,
                'deskripsi' => 'Membantu operasional harian cafe, cleaning service, dan tugas umum',
                'is_active' => true
            ]
        ];

        foreach ($gajiData as $data) {
            Gaji::create($data);
        }
    }
}
