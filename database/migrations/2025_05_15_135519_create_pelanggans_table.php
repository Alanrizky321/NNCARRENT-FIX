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
                $table->string('email', 50);
                $table->string('no_hp', 13);
                $table->string('password', 255);
                $table->timestamps();
            
        
        });
    }

    /**
     * Reverse the migrations.
     */
  public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->renameColumn('email', 'Email');
        });
    }
};
