<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('user_id')->nullable(); // Menambahkan user_id untuk relasi
            $table->string('nama_pelanggan');
            $table->string('nomor_hp');
            $table->string('email');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('ktp_photo_path')->nullable();
            $table->string('sim_photo_path')->nullable();
            $table->string('bukti_pembayaran_path')->nullable();
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->enum('antar_jemput', ['antar-jemput', 'ambil-garasi'])->nullable();
            $table->string('lokasi_antar')->nullable();
            $table->string('lokasi_jemput')->nullable();
            $table->enum('status', ['pending', 'on_going', 'finished', 'canceled', 'archived'])->default('pending');
            $table->timestamps();

            $table->foreign('mobil_id')->references('ID_Mobil')->on('mobil')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('laporan_id')->nullable();
            $table->foreign('laporan_id')->references('id')->on('laporans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesans');
    }
}
