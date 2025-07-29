<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Fixing User Roles Based on Requirements ===\n";

// Target karyawan yang harus jadi staff: deden, mimin, neneng, dadang, lilis
$targetStaffNames = ['Deden', 'Mimin', 'Neneng', 'Dadang', 'Lilis'];

foreach ($targetStaffNames as $name) {
    // Cari user berdasarkan nama
    $user = \App\Models\User::where('name', $name)->first();
    if ($user) {
        $user->update(['role' => 'staff']);
        echo "✅ Updated user '{$name}' to staff role\n";
    } else {
        echo "❌ User '{$name}' not found\n";
    }
}

// Set role berdasarkan posisi untuk user lainnya
$users = \App\Models\User::whereNotIn('name', array_merge($targetStaffNames, ['Admin Cafe', 'Karyawan Cafe']))->get();

foreach ($users as $user) {
    $karyawan = $user->karyawan;
    if ($karyawan) {
        $role = 'staff'; // default

        // Map posisi to role
        if (stripos($karyawan->posisi ?? '', 'kasir') !== false) {
            $role = 'kasir';
        } elseif (stripos($karyawan->posisi ?? '', 'barista') !== false) {
            $role = 'barista';
        }

        $user->update(['role' => $role]);
        echo "✅ Updated user '{$user->name}' (posisi: {$karyawan->posisi}) to {$role} role\n";
    }
}

echo "\n=== Final User Roles ===\n";
$allUsers = \App\Models\User::all();
foreach ($allUsers as $user) {
    $karyawanInfo = $user->karyawan ? " (karyawan: {$user->karyawan->nama}, posisi: {$user->karyawan->posisi})" : "";
    echo "User: {$user->name} | Role: {$user->role}{$karyawanInfo}\n";
}
