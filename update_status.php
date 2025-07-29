<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Karyawan;

echo "Updating existing karyawan status..." . PHP_EOL;

// Update semua karyawan yang belum memiliki status menjadi 'aktif'
$updated = Karyawan::whereNull('status')->update(['status' => 'aktif']);

echo "Updated {$updated} karyawan records to 'aktif' status." . PHP_EOL;

// Tampilkan semua data karyawan dengan status
echo "Current karyawan status:" . PHP_EOL;
$allKaryawan = Karyawan::all();
foreach ($allKaryawan as $k) {
    echo "- {$k->nama} ({$k->posisi}) - Status: {$k->status}" . PHP_EOL;
}
