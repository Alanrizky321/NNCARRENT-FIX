<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggan'; // Nama tabel
    protected $primaryKey = 'ID_Pelanggan'; // Primary key
    public $incrementing = true; // Primary key auto-increment
    protected $fillable = ['email', 'no_hp', 'password'];

    // Jika timestamp tidak digunakan, tambahkan ini
    public $timestamps = true;
}