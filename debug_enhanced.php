<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Transaksi;
use App\Models\Menu;

// Get a specific transaction for testing
$transaksi = Transaksi::where('status', 'proses')->first();

if (!$transaksi) {
    echo "No transaction found with status 'proses'\n";
    exit;
}

echo "=== TESTING getOrderDetails OUTPUT ===\n";
echo "Transaksi ID: {$transaksi->id}\n";
echo "Kode: {$transaksi->kode_transaksi}\n";
echo "Status: {$transaksi->status}\n\n";

echo "=== RAW PESANAN ===\n";
var_dump($transaksi->pesanan);

echo "\n=== ENHANCED PESANAN (simulating getOrderDetails) ===\n";
$enhancedPesanan = [];
foreach ($transaksi->pesanan as $pesananItem) {
    echo "Processing item:\n";
    var_dump($pesananItem);

    $pesananData = $pesananItem;

    // Try to get recipe from menu table if menu_id exists
    if (isset($pesananItem['menu_id'])) {
        echo "  Menu ID found: {$pesananItem['menu_id']}\n";
        $menu = Menu::find($pesananItem['menu_id']);
        if ($menu) {
            echo "  Menu found: {$menu->nama}\n";
            $pesananData['resep'] = $menu->resep ?? 'Resep tidak tersedia';
            $pesananData['kategori'] = $menu->kategori;
            // ADD THE MISSING NAMA FIELD!
            $pesananData['nama'] = $pesananData['nama'] ?? $menu->nama;
        } else {
            echo "  Menu NOT found!\n";
        }
    } else {
        echo "  No menu_id found\n";
        $pesananData['resep'] = 'Resep tidak tersedia untuk format pesanan ini';
        $pesananData['kategori'] = 'Menu';
    }

    echo "  Final pesanan data:\n";
    var_dump($pesananData);
    echo "\n";

    $enhancedPesanan[] = $pesananData;
}

echo "=== FINAL ENHANCED PESANAN ===\n";
var_dump($enhancedPesanan);
