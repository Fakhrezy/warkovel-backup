<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Transaksi;
use App\Models\Menu;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DEBUG PESANAN DATA ===" . PHP_EOL;

// Get latest transaction
$transaksi = Transaksi::latest()->first();

if ($transaksi) {
    echo "Transaksi ID: " . $transaksi->id . PHP_EOL;
    echo "Kode: " . $transaksi->kode_transaksi . PHP_EOL;
    echo "Status: " . $transaksi->status . PHP_EOL;
    echo PHP_EOL;

    echo "=== PESANAN DATA ===" . PHP_EOL;
    echo "Raw pesanan data:" . PHP_EOL;
    echo json_encode($transaksi->pesanan, JSON_PRETTY_PRINT) . PHP_EOL;
    echo PHP_EOL;

    echo "=== PROCESSING EACH ITEM ===" . PHP_EOL;
    foreach ($transaksi->pesanan as $index => $pesananItem) {
        echo "Item {$index}:" . PHP_EOL;
        echo "  Raw data: " . json_encode($pesananItem, JSON_PRETTY_PRINT) . PHP_EOL;

        if (isset($pesananItem['menu_id'])) {
            echo "  Menu ID found: " . $pesananItem['menu_id'] . PHP_EOL;
            $menu = Menu::find($pesananItem['menu_id']);
            if ($menu) {
                echo "  Menu found: " . $menu->nama . PHP_EOL;
                echo "  Recipe: " . ($menu->resep ?? 'NULL') . PHP_EOL;
                echo "  Category: " . ($menu->kategori ?? 'NULL') . PHP_EOL;
            } else {
                echo "  Menu NOT found!" . PHP_EOL;
            }
        } else {
            echo "  No menu_id found!" . PHP_EOL;
            echo "  Available keys: " . implode(', ', array_keys($pesananItem)) . PHP_EOL;
        }
        echo PHP_EOL;
    }
} else {
    echo "No transactions found!" . PHP_EOL;
}
