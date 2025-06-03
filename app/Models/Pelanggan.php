<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan'; // nama tabel
    protected $primaryKey = 'ID_Pelanggan'; // kunci utama sesuai migration
    protected $fillable = ['email', 'no_hp', 'password'];
    protected $hidden = ['password'];
    public $timestamps = true;
}
