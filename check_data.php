<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Data Users dengan Role Karyawan ===\n";

$karyawanUsers = \App\Models\User::role('karyawan')->with('karyawan')->get();

foreach ($karyawanUsers as $user) {
    $karyawan = $user->karyawan;
    echo sprintf(
        "User: %s (ID: %d) - Karyawan: %s\n",
        $user->name,
        $user->id,
        $karyawan ? $karyawan->nama . " (ID: {$karyawan->id})" : "NULL"
    );
}

echo "\n=== Data Karyawan tanpa User ===\n";
$karyawanTanpaUser = \App\Models\Karyawan::whereNull('user_id')->get();
foreach ($karyawanTanpaUser as $k) {
    echo "Karyawan: {$k->nama} (ID: {$k->id}) - Tanpa User\n";
}
