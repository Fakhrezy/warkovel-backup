<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

// Tampilkan semua user dan role mereka
echo "=== SEMUA USER DAN ROLE ===\n";
$users = User::with('roles')->get();
foreach($users as $user) {
    $roles = $user->roles->pluck('name')->toArray();
    echo $user->name . ' (' . $user->email . ') - Roles: ' . implode(', ', $roles) . "\n";
}

echo "\n=== ASSIGN ROLE KASIR ===\n";
echo "Pilih user mana yang akan diberi role kasir:\n";
foreach($users as $index => $user) {
    echo ($index + 1) . ". " . $user->name . ' (' . $user->email . ")\n";
}

// Contoh assign role kasir ke user pertama
// Ganti sesuai kebutuhan
$firstUser = $users->first();
if($firstUser) {
    $firstUser->assignRole('kasir');
    echo "\nRole kasir berhasil di-assign ke: " . $firstUser->name . "\n";

    // Verifikasi
    $firstUser->refresh();
    $roles = $firstUser->roles->pluck('name')->toArray();
    echo "Roles sekarang: " . implode(', ', $roles) . "\n";
}

?>
