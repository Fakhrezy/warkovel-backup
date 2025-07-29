<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Show all users
echo "Daftar Users:\n";
$users = \App\Models\User::all();

foreach ($users as $user) {
    echo "ID: {$user->id}, Email: {$user->email}, Name: {$user->name}\n";
    $roles = $user->getRoleNames();
    echo "  Current roles: " . ($roles->count() > 0 ? $roles->join(', ') : 'none') . "\n";
}

// Ask which user to assign kasir role to
echo "\n" . str_repeat('=', 50) . "\n";
echo "Untuk assign role kasir, gunakan salah satu command berikut:\n\n";

foreach ($users as $user) {
    echo "// Assign kasir role ke {$user->name} ({$user->email}):\n";
    echo "php artisan tinker --execute=\"\$user = \\App\\Models\\User::find({$user->id}); \$user->assignRole('kasir'); echo 'Role kasir berhasil di-assign ke {$user->name}' . PHP_EOL;\"\n\n";
}
