<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id('ID_Mobil');
            $table->string('Merek', 255);
            $table->string('Model', 255);
            $table->integer('Tahun');
            $table->decimal('Harga_Sewa', 10, 2);
            $table->string('Foto', 255)->nullable();
            $table->boolean('Status_Ketersediaan')->default(true);
            $table->unsignedBigInteger('Kategori_ID');
            $table->unsignedBigInteger('ID_Admin');
            $table->integer('Jumlah_Kursi'); // Menambahkan kolom Jumlah Kursi
            $table->enum('Jenis_Transmisi', ['manual', 'automatic']); // Menambahkan kolom Jenis Transmisi
            $table->timestamps();
            $table->softDeletes();

            // Menambahkan relasi foreign key
            $table->foreign('Kategori_ID')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('ID_Admin')->references('ID_Admin')->on('admin')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
