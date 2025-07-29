<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== WORKFLOW DEMO: ANTRI → SELESAI ===\n\n";

// Ambil transaksi dengan status antri
$transaksiAntri = \App\Models\Transaksi::where('status', 'antri')
    ->whereDate('created_at', today())
    ->first();

if ($transaksiAntri) {
    echo "📋 TRANSAKSI DALAM ANTRIAN:\n";
    echo "   Kode: {$transaksiAntri->kode_transaksi}\n";
    echo "   Status: {$transaksiAntri->status}\n";
    echo "   Total: Rp " . number_format($transaksiAntri->total_transaksi, 0, ',', '.') . "\n";
    echo "   Pesanan:\n";

    foreach ($transaksiAntri->pesanan as $item) {
        $nama = $item['nama'] ?? $item['nama_menu'] ?? 'Menu tidak dikenal';
        $jumlah = $item['jumlah'] ?? 1;
        $subtotal = $item['subtotal'] ?? 0;
        echo "   - {$nama} x{$jumlah} = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
    }

    echo "\n🍳 SIMULASI: Barista/Dapur menyelesaikan pesanan...\n";

    // Update status ke selesai
    $transaksiAntri->update(['status' => 'selesai']);

    echo "✅ Status berhasil diubah ke: {$transaksiAntri->fresh()->status}\n\n";

    // Check updated statistics
    echo "=== UPDATED DASHBOARD STATISTICS ===\n";
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
    echo "Pendapatan (sekarang dihitung): Rp " . number_format($totalPendapatanHari, 0, ',', '.') . "\n\n";

    echo "💡 WORKFLOW COMPLETE:\n";
    echo "1. ✅ Kasir checkout → Status: 'antri'\n";
    echo "2. ✅ Barista/Dapur proses → Status: 'selesai'\n";
    echo "3. ✅ Pendapatan tercatat di dashboard\n";

} else {
    echo "❌ No transactions with 'antri' status found\n";
    echo "Create a transaction first by using the checkout function\n";
}
