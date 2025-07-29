<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check users with kasir role
$kasirUsers = \App\Models\User::role('kasir')->get();

echo "Users dengan role kasir: " . $kasirUsers->count() . "\n";

foreach ($kasirUsers as $user) {
    echo "- ID: {$user->id}, Email: {$user->email}, Name: {$user->name}\n";

    // Check specific roles
    $roles = $user->getRoleNames();
    echo "  Roles: " . $roles->join(', ') . "\n";
}

// Also check all roles in system
echo "\nSemua role yang tersedia:\n";
$allRoles = \Spatie\Permission\Models\Role::all();
foreach ($allRoles as $role) {
    $userCount = \App\Models\User::role($role->name)->count();
    echo "- {$role->name}: {$userCount} users\n";
}
