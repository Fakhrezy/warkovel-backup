<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Data Karyawan dan User ===\n";

$karyawans = \App\Models\Karyawan::with('user')->get();

foreach ($karyawans as $karyawan) {
    $userName = $karyawan->user ? $karyawan->user->name : 'No User';
    $userRole = $karyawan->user && isset($karyawan->user->role) ? $karyawan->user->role : 'No Role';

    echo sprintf(
        "Karyawan: %-10s | Posisi: %-10s | User: %-15s | Current Role: %s\n",
        $karyawan->nama,
        $karyawan->posisi ?? 'N/A',
        $userName,
        $userRole
    );
}

echo "\n=== Admin Users ===\n";
$adminUsers = \App\Models\User::role('admin')->get();
foreach ($adminUsers as $user) {
    $currentRole = isset($user->role) ? $user->role : 'No Role';
    echo "Admin: {$user->name} | Current Role: {$currentRole}\n";
}
