<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Create some dummy transactions for today
$menus = \App\Models\Menu::all();

if ($menus->count() > 0) {
    echo "Creating dummy transactions for today...\n";

    for ($i = 1; $i <= 5; $i++) {
        $randomMenu = $menus->random();
        $jumlah = rand(1, 3);
        $totalTransaksi = $randomMenu->harga * $jumlah;

        $transaksi = \App\Models\Transaksi::create([
            'tanggal_transaksi' => today(),
            'pesanan' => [
                [
                    'menu_id' => $randomMenu->id,
                    'nama' => $randomMenu->nama,
                    'harga' => $randomMenu->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $totalTransaksi
                ]
            ],
            'total_transaksi' => $totalTransaksi,
            'status' => $i % 2 == 0 ? 'selesai' : 'antri'
        ]);

        echo "Transaksi {$transaksi->kode_transaksi} created: {$randomMenu->nama} x{$jumlah} = Rp " . number_format($totalTransaksi, 0, ',', '.') . " ({$transaksi->status})\n";
    }

    echo "\nSummary:\n";
    $totalTransaksiHari = \App\Models\Transaksi::whereDate('created_at', today())->count();
    $totalPendapatanHari = \App\Models\Transaksi::whereDate('created_at', today())
        ->where('status', 'selesai')
        ->sum('total_transaksi');

    echo "Total transaksi hari ini: {$totalTransaksiHari}\n";
    echo "Total pendapatan hari ini: Rp " . number_format($totalPendapatanHari, 0, ',', '.') . "\n";
} else {
    echo "No menu items found. Please seed the menu data first.\n";
}
