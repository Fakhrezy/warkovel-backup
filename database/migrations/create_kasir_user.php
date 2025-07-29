<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up()
    {
        // Buat role kasir jika belum ada
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);

        // Buat user kasir
        $kasirUser = User::firstOrCreate(
            ['email' => 'kasir@cafe.com'],
            [
                'name' => 'Kasir Cafe',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign role
        $kasirUser->assignRole('kasir');

        echo "User kasir berhasil dibuat dengan:\n";
        echo "Email: kasir@cafe.com\n";
        echo "Password: password123\n";
    }

    public function down()
    {
        User::where('email', 'kasir@cafe.com')->delete();
    }
};
