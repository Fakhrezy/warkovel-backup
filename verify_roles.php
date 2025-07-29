<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== FINAL USER ROLES VERIFICATION ===\n\n";

$users = \App\Models\User::with('karyawan')->get();

echo "📋 All Users and Their Roles:\n";
echo str_repeat("=", 80) . "\n";
printf("%-15s | %-8s | %-15s | %-10s | %-15s\n",
    "Name", "DB Role", "Karyawan", "Position", "Spatie Role");
echo str_repeat("-", 80) . "\n";

foreach ($users as $user) {
    $karyawanName = $user->karyawan ? $user->karyawan->nama : '-';
    $position = $user->karyawan ? $user->karyawan->posisi : '-';
    $spatieRole = $user->getRoleNames()->first() ?? '-';

    printf("%-15s | %-8s | %-15s | %-10s | %-15s\n",
        substr($user->name, 0, 14),
        $user->role ?? 'NULL',
        substr($karyawanName, 0, 14),
        substr($position, 0, 9),
        substr($spatieRole, 0, 14)
    );
}

echo "\n🎯 Target Requirements Check:\n";
echo str_repeat("=", 50) . "\n";

$targetStaff = ['Deden', 'Mimin', 'Neneng', 'Dadang', 'Lilis'];
foreach ($targetStaff as $name) {
    $user = \App\Models\User::where('name', $name)->first();
    if ($user) {
        $status = $user->role === 'staff' ? '✅' : '❌';
        echo "{$status} {$name}: {$user->role}\n";
    } else {
        echo "❌ {$name}: User not found\n";
    }
}

echo "\n📊 Role Distribution:\n";
echo str_repeat("=", 30) . "\n";
$roleCount = \App\Models\User::selectRaw('role, COUNT(*) as count')
    ->groupBy('role')
    ->get();

foreach ($roleCount as $role) {
    echo "{$role->role}: {$role->count} users\n";
}

echo "\n✅ Verification Complete!\n";
