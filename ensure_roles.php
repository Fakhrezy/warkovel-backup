<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Spatie\Permission\Models\Role;

echo "=== Ensuring Required Roles Exist ===\n";

$requiredRoles = ['admin', 'barista', 'kasir', 'staff', 'karyawan'];

foreach ($requiredRoles as $roleName) {
    $role = Role::where('name', $roleName)->first();

    if (!$role) {
        Role::create(['name' => $roleName]);
        echo "✅ Created role: {$roleName}\n";
    } else {
        echo "✅ Role exists: {$roleName}\n";
    }
}

echo "\n=== All Required Roles Ready ===\n";
