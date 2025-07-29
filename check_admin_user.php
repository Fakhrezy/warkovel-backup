<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "=== Checking Admin Users ===\n";

// Check if admin role exists
$adminRole = Role::where('name', 'admin')->first();
if (!$adminRole) {
    echo "❌ Admin role not found! Creating admin role...\n";
    $adminRole = Role::create(['name' => 'admin']);
    echo "✅ Admin role created successfully\n";
} else {
    echo "✅ Admin role exists\n";
}

// Check users
$users = User::all();
echo "\n=== All Users ===\n";
foreach ($users as $user) {
    $roles = $user->getRoleNames()->implode(', ');
    echo "User: {$user->name} | Email: {$user->email} | Roles: {$roles}\n";
}

// Check if there's any admin user
$adminUsers = User::role('admin')->get();
if ($adminUsers->count() == 0) {
    echo "\n❌ No admin users found!\n";
    echo "Creating default admin user...\n";

    $adminUser = User::create([
        'name' => 'Admin',
        'email' => 'admin@cafe.com',
        'password' => bcrypt('password123'),
        'email_verified_at' => now(),
    ]);

    $adminUser->assignRole('admin');
    echo "✅ Admin user created successfully!\n";
    echo "Email: admin@cafe.com\n";
    echo "Password: password123\n";
} else {
    echo "\n✅ Admin users found:\n";
    foreach ($adminUsers as $admin) {
        echo "- {$admin->name} ({$admin->email})\n";
    }
}

echo "\n=== Done ===\n";
