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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->date('tanggal_transaksi');
            $table->json('pesanan'); // Menyimpan detail menu yang dibeli
            $table->decimal('total_transaksi', 10, 2);
            $table->enum('status', ['antri', 'selesai'])->default('antri');
            $table->timestamps();

            // Index untuk performa query
            $table->index(['tanggal_transaksi', 'status']);
            $table->index('kode_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
