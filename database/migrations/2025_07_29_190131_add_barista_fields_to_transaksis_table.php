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
        Schema::table('transaksis', function (Blueprint $table) {
            // Update status enum to include 'proses'
            $table->enum('status', ['antri', 'proses', 'selesai'])->default('antri')->change();

            // Add barista fields
            $table->unsignedBigInteger('barista_id')->nullable()->after('status');
            $table->timestamp('started_at')->nullable()->after('barista_id');
            $table->timestamp('completed_at')->nullable()->after('started_at');

            // Add foreign key constraint for barista
            $table->foreign('barista_id')->references('id')->on('users')->onDelete('set null');

            // Add index for barista queries
            $table->index(['status', 'barista_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Drop foreign key and index first
            $table->dropForeign(['barista_id']);
            $table->dropIndex(['status', 'barista_id']);

            // Drop added columns
            $table->dropColumn(['barista_id', 'started_at', 'completed_at']);

            // Revert status enum back to original
            $table->enum('status', ['antri', 'selesai'])->default('antri')->change();
        });
    }
};
