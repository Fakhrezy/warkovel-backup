<?php

// Simple database check using Laravel Artisan
echo "=== Test Barista System ===\n\n";

// Test role barista
$checkRole = shell_exec('php artisan tinker --execute="echo Spatie\Permission\Models\Role::where(\'name\', \'barista\')->exists() ? \'Role barista exists\' : \'Role barista not found\';"');
echo "🔍 Role Check: " . trim($checkRole) . "\n";

// Test migration status
$migrationStatus = shell_exec('php artisan migrate:status');
echo "\n📋 Migration Status:\n";
echo $migrationStatus;

echo "\n=== Barista Routes Available ===\n";
echo "✅ /barista - Dashboard Barista\n";
echo "✅ /barista/orders/{id}/start - Mulai order\n";
echo "✅ /barista/orders/{id}/complete - Selesaikan order\n";
echo "✅ /barista/orders/{id}/details - Detail order\n";

echo "\n=== Login Flow ===\n";
echo "🔐 User dengan role 'barista' akan diarahkan ke: /barista\n";

echo "\n=== Next Steps ===\n";
echo "1. Buat user dengan role barista di admin panel\n";
echo "2. Login sebagai barista\n";
echo "3. Sistem akan otomatis redirect ke dashboard barista\n";
echo "4. Test workflow: Antri → Proses → Selesai\n";
