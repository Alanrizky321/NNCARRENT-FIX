<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
        use HasFactory;
        use Notifiable;

    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'ID_Admin'; // Primary key
    public $incrementing = true; // Primary key auto-increment
    protected $fillable = ['email', 'no_hp', 'password'];

    // Jika timestamp tidak digunakan, tambahkan ini
    public $timestamps = true;
}
