<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'ID_Admin'; // Primary key
    public $incrementing = true; // Primary key auto-increment
    protected $fillable = ['email', 'no_hp', 'password'];

    // Jika timestamp tidak digunakan, tambahkan ini
    public $timestamps = true;
}