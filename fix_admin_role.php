<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "=== Fixing Admin User Role ===\n";

// Find the existing admin user
$adminUser = User::where('email', 'admin@cafe.com')->first();

if ($adminUser) {
    echo "✅ Found user: {$adminUser->name} ({$adminUser->email})\n";

    // Check current roles
    $currentRoles = $adminUser->getRoleNames();
    echo "Current roles: " . $currentRoles->implode(', ') . "\n";

    // Assign admin role if not already assigned
    if (!$adminUser->hasRole('admin')) {
        $adminUser->assignRole('admin');
        echo "✅ Admin role assigned successfully!\n";
    } else {
        echo "✅ User already has admin role\n";
    }

    // Verify the role assignment
    $adminUser->refresh();
    $updatedRoles = $adminUser->getRoleNames();
    echo "Updated roles: " . $updatedRoles->implode(', ') . "\n";

    echo "\n🎯 Login credentials:\n";
    echo "Email: admin@cafe.com\n";
    echo "Password: (use the password you already set)\n";

} else {
    echo "❌ Admin user not found!\n";
}

echo "\n=== Done ===\n";
