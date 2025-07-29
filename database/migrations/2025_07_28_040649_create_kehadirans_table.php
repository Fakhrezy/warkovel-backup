<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->enum('status_kehadiran', ['hadir', 'tidak_hadir', 'terlambat', 'izin', 'sakit']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Index untuk performa query
            $table->index(['karyawan_id', 'tanggal']);
            $table->unique(['karyawan_id', 'tanggal']); // Satu karyawan hanya bisa satu kehadiran per hari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
