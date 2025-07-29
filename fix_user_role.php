<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Memperbaiki User tanpa Data Karyawan ===\n";

$user = \App\Models\User::find(2);
if ($user && $user->hasRole('karyawan') && !$user->karyawan) {
    echo "User: {$user->name} memiliki role karyawan tapi tidak ada data karyawan\n";

    // Opsi 1: Hapus role karyawan
    $user->removeRole('karyawan');
    echo "Role karyawan dihapus dari user: {$user->name}\n";

    // Opsi 2: Atau beri role admin jika memang admin
    $user->assignRole('admin');
    echo "Role admin diberikan ke user: {$user->name}\n";
}

echo "=== Selesai ===\n";
