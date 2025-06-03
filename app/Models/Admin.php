<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'admin';  // Nama tabel admin

    // Tentukan kolom yang digunakan sebagai primary key
    protected $primaryKey = 'ID_Admin';  // Ganti dengan nama kolom primary key yang sesuai

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'email', 'password',
    ];

    // Tentukan kolom yang tidak boleh diisi
    protected $guarded = [];

    // Tentukan kolom password yang di-hash
    protected $hidden = [
        'password',
    ];

    // Tentukan tipe data untuk kolom timestamps
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
