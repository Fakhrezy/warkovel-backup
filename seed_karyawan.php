<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Karyawan;

echo "Creating Karyawan data..." . PHP_EOL;

// Get existing users
$users = User::with('roles')->get();

foreach ($users as $user) {
    $role = $user->getRoleNames()->first();

    // Skip if karyawan data already exists
    if ($user->karyawan) {
        echo "Karyawan data for {$user->name} already exists." . PHP_EOL;
        continue;
    }

    if ($role) {
        $gajiMap = [
            'admin' => 10000000,
            'karyawan' => 4000000,
            'barista' => 4500000,
            'kasir' => 3500000
        ];

        $alamatMap = [
            'admin' => 'Jl. Admin No. 1, Jakarta',
            'karyawan' => 'Jl. Karyawan No. 2, Jakarta',
            'barista' => 'Jl. Barista No. 3, Jakarta',
            'kasir' => 'Jl. Kasir No. 4, Jakarta'
        ];

        $jenisKelaminMap = [
            'Admin Cafe' => 'Laki-laki',
            'Karyawan Cafe' => 'Perempuan',
            'Barista Cafe' => 'Laki-laki',
            'Kasir Cafe' => 'Perempuan'
        ];

        $umurMap = [
            'Admin Cafe' => 30,
            'Karyawan Cafe' => 25,
            'Barista Cafe' => 28,
            'Kasir Cafe' => 23
        ];

        Karyawan::create([
            'nama' => $user->name,
            'umur' => $umurMap[$user->name] ?? 25,
            'jenis_kelamin' => $jenisKelaminMap[$user->name] ?? 'Laki-laki',
            'alamat' => $alamatMap[$role] ?? 'Jakarta',
            'posisi' => $role,
            'gaji' => $gajiMap[$role] ?? 4000000,
            'user_id' => $user->id
        ]);

        echo "Created karyawan data for {$user->name} ({$role})" . PHP_EOL;
    }
}

// Create additional random karyawan
echo "Creating additional random karyawan..." . PHP_EOL;
$additionalKaryawan = Karyawan::factory(5)->create();
echo "Created " . count($additionalKaryawan) . " additional karyawan records." . PHP_EOL;

echo "Showing all karyawan data:" . PHP_EOL;
$allKaryawan = Karyawan::with('user')->get();
foreach ($allKaryawan as $k) {
    echo "- {$k->nama} ({$k->posisi}) - Gaji: Rp " . number_format($k->gaji, 0, ',', '.') .
         ($k->user ? " - User: {$k->user->email}" : " - No User Account") . PHP_EOL;
}
