<?php

require_once 'bootstrap/app.php';

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

echo "=== Membuat User Barista ===\n\n";

try {
    // Check if barista role exists
    $baristaRole = Role::where('name', 'barista')->first();
    if (!$baristaRole) {
        echo "❌ Role barista tidak ditemukan. Membuat role...\n";
        $baristaRole = Role::create(['name' => 'barista']);
        echo "✅ Role barista berhasil dibuat\n";
    }

    // Check if barista user already exists
    $existingBarista = User::where('email', 'barista@cafe.com')->first();
    if ($existingBarista) {
        echo "⚠️  User barista sudah ada: {$existingBarista->email}\n";
        echo "   Memperbarui role...\n";
        $existingBarista->syncRoles(['barista']);
        echo "✅ Role barista berhasil diperbarui\n";
    } else {
        // Create new barista user
        $barista = User::create([
            'name' => 'Barista Café',
            'email' => 'barista@cafe.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Assign barista role
        $barista->assignRole('barista');

        echo "✅ User barista berhasil dibuat:\n";
        echo "   Nama: {$barista->name}\n";
        echo "   Email: {$barista->email}\n";
        echo "   Password: password123\n";
    }

    echo "\n=== Login Info ===\n";
    echo "📧 Email: barista@cafe.com\n";
    echo "🔑 Password: password123\n";
    echo "🏠 Akan diarahkan ke: /barista\n";

    echo "\n=== Workflow Barista ===\n";
    echo "1. Login sebagai barista\n";
    echo "2. Lihat antrian pesanan (status: antri)\n";
    echo "3. Klik 'Mulai' untuk memproses pesanan (status: proses)\n";
    echo "4. Klik 'Selesai' untuk menyelesaikan pesanan (status: selesai)\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
