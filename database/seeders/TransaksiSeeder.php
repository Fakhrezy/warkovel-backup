<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Menu;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating sample transactions...');

        // Ambil semua menu yang tersedia
        $menus = Menu::all();

        if ($menus->isEmpty()) {
            $this->command->info('No menus found. Please seed menus first.');
            return;
        }

        // Buat transaksi untuk 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            // Buat 3-8 transaksi per hari
            $transactionCount = rand(3, 8);

            for ($j = 0; $j < $transactionCount; $j++) {
                // Generate kode transaksi
                $kodeTransaksi = 'TRX' . $date->format('Ymd') . str_pad(($j + 1), 3, '0', STR_PAD_LEFT);

                // Pilih menu secara random (1-4 item per transaksi)
                $itemCount = rand(1, 4);
                $pesanan = [];
                $totalTransaksi = 0;

                $selectedMenus = $menus->random($itemCount);

                foreach ($selectedMenus as $menu) {
                    $jumlah = rand(1, 3);
                    $subtotal = $menu->harga * $jumlah;

                    $pesanan[] = [
                        'menu_id' => $menu->id,
                        'nama_menu' => $menu->nama,
                        'harga' => $menu->harga,
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal
                    ];

                    $totalTransaksi += $subtotal;
                }

                // Random status (80% selesai, 20% antri)
                $status = rand(1, 100) <= 80 ? 'selesai' : 'antri';

                Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'tanggal_transaksi' => $date->format('Y-m-d'),
                    'pesanan' => $pesanan,
                    'total_transaksi' => $totalTransaksi,
                    'status' => $status
                ]);
            }
        }

        $this->command->info('Sample transactions created successfully!');
    }
}
