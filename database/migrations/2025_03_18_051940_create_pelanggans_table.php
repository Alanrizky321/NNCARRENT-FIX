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
       
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->id('ID_Pelanggan');
                $table->string('Email', 50);
                $table->string('No_Hp', 13);
                $table->string('Password', 25);
                $table->timestamps();
            
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
