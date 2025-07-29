<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Assign kasir role to user with email kasir@cafe.com
$user = \App\Models\User::find(7); // Kasir Cafe
$user->assignRole('kasir');

echo "Role kasir berhasil di-assign ke {$user->name} ({$user->email})\n";

// Verify the assignment
$kasirUsers = \App\Models\User::role('kasir')->get();
echo "\nVerifikasi - Users dengan role kasir: " . $kasirUsers->count() . "\n";

foreach ($kasirUsers as $kasirUser) {
    echo "- ID: {$kasirUser->id}, Email: {$kasirUser->email}, Name: {$kasirUser->name}\n";
    $roles = $kasirUser->getRoleNames();
    echo "  Roles: " . $roles->join(', ') . "\n";
}
