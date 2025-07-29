<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== Testing Admin Login Redirect ===\n";

// Find admin user
$adminUser = User::where('email', 'admin@cafe.com')->first();

if ($adminUser) {
    echo "✅ Admin user found: {$adminUser->name}\n";
    echo "✅ Admin roles: " . $adminUser->getRoleNames()->implode(', ') . "\n";

    // Test hasRole method
    if ($adminUser->hasRole('admin')) {
        echo "✅ hasRole('admin') returns TRUE\n";
        echo "🎯 Admin should be redirected to: " . route('admin.dashboard') . "\n";
    } else {
        echo "❌ hasRole('admin') returns FALSE\n";
    }

    // Check route exists
    try {
        $adminDashboardUrl = route('admin.dashboard');
        echo "✅ Admin dashboard route exists: {$adminDashboardUrl}\n";
    } catch (Exception $e) {
        echo "❌ Admin dashboard route error: " . $e->getMessage() . "\n";
    }

} else {
    echo "❌ Admin user not found!\n";
}

echo "\n=== Authentication Flow Test ===\n";
echo "1. Login dengan: admin@cafe.com\n";
echo "2. AuthenticatedSessionController akan check: \$user->hasRole('admin')\n";
echo "3. Jika TRUE → redirect ke: " . route('admin.dashboard') . "\n";
echo "4. Route admin.dashboard → DashboardController@admin\n";
echo "5. Controller return view('admin') → admin.blade.php\n";

echo "\n=== Done ===\n";
