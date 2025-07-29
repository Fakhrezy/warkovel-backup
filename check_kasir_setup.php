<?php

// Script untuk membuat role kasir dan mengecek setup
// Jalankan dengan: php artisan tinker
// Kemudian copy-paste kode ini

use Spatie\Permission\Models\Role;
use App\Models\User;

// 1. Buat role kasir jika belum ada
$kasirRole = Role::firstOrCreate(['name' => 'kasir']);
echo "Role kasir: " . ($kasirRole->wasRecentlyCreated ? "DIBUAT BARU" : "SUDAH ADA") . "\n";

// 2. Lihat semua role yang ada
echo "\n=== SEMUA ROLE ===\n";
$roles = Role::all();
foreach($roles as $role) {
    echo "- " . $role->name . " (ID: " . $role->id . ")\n";
}

// 3. Lihat semua user
echo "\n=== SEMUA USER ===\n";
$users = User::with('roles')->get();
foreach($users as $user) {
    $userRoles = $user->roles->pluck('name')->toArray();
    echo "- " . $user->name . " (" . $user->email . ") - Roles: " . implode(', ', $userRoles) . "\n";
}

// 4. Assign role kasir ke user tertentu (ganti email sesuai kebutuhan)
echo "\n=== ASSIGN ROLE KASIR ===\n";
echo "Untuk assign role kasir ke user, jalankan:\n";
echo '$user = User::where("email", "kasir@example.com")->first();' . "\n";
echo '$user->assignRole("kasir");' . "\n";
echo 'echo "Role kasir berhasil di-assign ke " . $user->name;' . "\n";

// 5. Test role checking
echo "\n=== TEST ROLE CHECKING ===\n";
echo "Untuk test apakah user memiliki role kasir:\n";
echo '$user = User::where("email", "kasir@example.com")->first();' . "\n";
echo 'echo $user->hasRole("kasir") ? "USER MEMILIKI ROLE KASIR" : "USER TIDAK MEMILIKI ROLE KASIR";' . "\n";

?>
