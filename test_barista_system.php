<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
require_once 'bootstrap/app.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test Barista System ===\n\n";

// 1. Check if barista role exists
$baristaRole = DB::table('roles')->where('name', 'barista')->first();
if ($baristaRole) {
    echo "✅ Role 'barista' sudah ada (ID: {$baristaRole->id})\n";
} else {
    echo "❌ Role 'barista' belum ada\n";
    echo "   Membuat role barista...\n";

    $roleId = DB::table('roles')->insertGetId([
        'name' => 'barista',
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    echo "✅ Role 'barista' berhasil dibuat (ID: {$roleId})\n";
}

// 2. Check if there are any users with barista role
$baristaUsers = DB::table('model_has_roles')
    ->join('users', 'model_has_roles.model_id', '=', 'users.id')
    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->where('roles.name', 'barista')
    ->select('users.name', 'users.email')
    ->get();

if ($baristaUsers->count() > 0) {
    echo "✅ User dengan role barista ditemukan:\n";
    foreach ($baristaUsers as $user) {
        echo "   - {$user->name} ({$user->email})\n";
    }
} else {
    echo "❌ Belum ada user dengan role barista\n";
}

// 3. Check transaksi table structure
$columns = DB::select("PRAGMA table_info(transaksis)");
$hasBaristaCols = false;
echo "\n✅ Struktur tabel transaksis:\n";
foreach ($columns as $col) {
    echo "   - {$col->name} ({$col->type})\n";
    if (in_array($col->name, ['barista_id', 'started_at', 'completed_at'])) {
        $hasBaristaCols = true;
    }
}

if ($hasBaristaCols) {
    echo "✅ Field barista sudah ada di tabel transaksis\n";
} else {
    echo "❌ Field barista belum ada di tabel transaksis\n";
}

// 4. Check for sample transactions
$sampleTransactions = DB::table('transaksis')->limit(3)->get();
echo "\n📊 Sample transaksi:\n";
if ($sampleTransactions->count() > 0) {
    foreach ($sampleTransactions as $transaksi) {
        echo "   - {$transaksi->kode_transaksi} | Status: {$transaksi->status} | Total: Rp " . number_format($transaksi->total_transaksi, 0, ',', '.') . "\n";
    }
} else {
    echo "   Belum ada transaksi\n";
}

echo "\n=== Test Complete ===\n";
echo "🎯 Untuk test barista system:\n";
echo "   1. Login sebagai user dengan role barista\n";
echo "   2. Akses: http://localhost:8000/barista\n";
echo "   3. Buat transaksi dari kasir untuk testing workflow\n";
