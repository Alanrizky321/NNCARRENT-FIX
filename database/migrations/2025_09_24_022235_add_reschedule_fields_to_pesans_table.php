<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesans', function (Blueprint $table) {  // Sesuaikan nama tabel jika bukan 'pesans'
            $table->date('reschedule_tanggal_mulai')->nullable();
            $table->date('reschedule_tanggal_selesai')->nullable();
            $table->string('reschedule_status')->nullable();  // Nilai: 'pending', 'approved', 'rejected'
        });
    }

    public function down(): void
    {
        Schema::table('pesans', function (Blueprint $table) {
            $table->dropColumn(['reschedule_tanggal_mulai', 'reschedule_tanggal_selesai', 'reschedule_status']);
        });
    }
};