<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggan'; // Nama tabel
    protected $primaryKey = 'ID_Pelanggan'; // Primary key
    public $incrementing = true; // Primary key auto-increment
    protected $fillable = ['email', 'no_hp', 'password'];

    // Jika timestamp tidak digunakan, tambahkan ini
    public $timestamps = true;

    public function pesanan(): HasMany
    {
        return $this->HasMany(Pesan::class, 'user_id', 'id');
    }
}
