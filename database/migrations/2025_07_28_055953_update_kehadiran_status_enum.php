<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing 'terlambat' records to 'hadir'
        DB::table('kehadirans')
            ->where('status_kehadiran', 'terlambat')
            ->update(['status_kehadiran' => 'hadir']);

        // Modify the enum column to remove 'terlambat'
        DB::statement("ALTER TABLE kehadirans MODIFY COLUMN status_kehadiran ENUM('hadir', 'tidak_hadir', 'izin', 'sakit') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original enum with 'terlambat'
        DB::statement("ALTER TABLE kehadirans MODIFY COLUMN status_kehadiran ENUM('hadir', 'tidak_hadir', 'terlambat', 'izin', 'sakit') NOT NULL");
    }
};
