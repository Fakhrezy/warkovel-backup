<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check kasir user details
$user = \App\Models\User::find(7); // Kasir Cafe

echo "User Details:\n";
echo "ID: {$user->id}\n";
echo "Name: {$user->name}\n";
echo "Email: {$user->email}\n";
echo "Roles: " . $user->getRoleNames()->join(', ') . "\n";
echo "Created: {$user->created_at}\n";

echo "\n" . str_repeat('=', 40) . "\n";
echo "Untuk reset password kasir (jika diperlukan):\n";
echo "php artisan tinker --execute=\"\$user = \\App\\Models\\User::find(7); \$user->password = \\Hash::make('password123'); \$user->save(); echo 'Password updated';\"\n";

echo "\nCredentials untuk login:\n";
echo "Email: kasir@cafe.com\n";
echo "Password: (default dari seeding/registrasi)\n";
