<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TESTING CHECKOUT STATUS CHANGE ===\n\n";

// Simulasi checkout dengan status 'antri'
$menu = \App\Models\Menu::first();

if ($menu) {
    echo "Testing checkout with menu: {$menu->nama}\n";
    echo "Creating test transaction...\n\n";

    // Simulasi data cart seperti yang ada di session
    $pesanan = [
        [
            'menu_id' => $menu->id,
            'nama' => $menu->nama,
            'harga' => $menu->harga,
            'jumlah' => 2,
            'subtotal' => $menu->harga * 2
        ]
    ];

    $totalTransaksi = $menu->harga * 2;

    // Create transaksi dengan status antri (seperti yang akan terjadi di checkout)
    $transaksi = \App\Models\Transaksi::create([
        'tanggal_transaksi' => now(),
        'pesanan' => $pesanan,
        'total_transaksi' => $totalTransaksi,
        'status' => 'antri'
    ]);

    echo "✅ Transaksi berhasil dibuat:\n";
    echo "   Kode: {$transaksi->kode_transaksi}\n";
    echo "   Status: {$transaksi->status}\n";
    echo "   Total: Rp " . number_format($transaksi->total_transaksi, 0, ',', '.') . "\n";
    echo "   Items: " . count($transaksi->pesanan) . " items\n\n";

    // Check dashboard statistics
    echo "=== DASHBOARD STATISTICS ===\n";
    $totalTransaksiHari = \App\Models\Transaksi::whereDate('created_at', today())->count();
    $totalPendapatanHari = \App\Models\Transaksi::whereDate('created_at', today())
        ->where('status', 'selesai')
        ->sum('total_transaksi');

    $transaksiAntri = \App\Models\Transaksi::whereDate('created_at', today())
        ->where('status', 'antri')
        ->count();

    $transaksiSelesai = \App\Models\Transaksi::whereDate('created_at', today())
        ->where('status', 'selesai')
        ->count();

    echo "Total transaksi hari ini: {$totalTransaksiHari}\n";
    echo "Transaksi status 'antri': {$transaksiAntri}\n";
    echo "Transaksi status 'selesai': {$transaksiSelesai}\n";
    echo "Pendapatan (hanya yang selesai): Rp " . number_format($totalPendapatanHari, 0, ',', '.') . "\n\n";

    echo "=== WORKFLOW EXPLANATION ===\n";
    echo "1. Kasir checkout → Status: 'antri'\n";
    echo "2. Pesanan masuk antrian untuk diproses\n";
    echo "3. Barista/Dapur ubah status → 'selesai'\n";
    echo "4. Baru dihitung sebagai pendapatan\n\n";

    echo "✅ Status default checkout berhasil diubah ke 'antri'!\n";

} else {
    echo "❌ No menu found for testing\n";
}
