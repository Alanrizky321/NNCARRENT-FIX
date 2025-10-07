<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mobil extends Model
{
    use HasFactory, SoftDeletes;  // 

    protected $table = 'mobil';       // nama tabel
    protected $primaryKey = 'ID_Mobil'; // primary key

    protected $fillable = [
        'Merek',
        'Model',
        'Tahun',
        'Harga_Sewa',
        'Foto',
        'Status_Ketersediaan',
        'Kategori_ID',
        'ID_Admin',
        'Jumlah_Kursi',
        'Jenis_Transmisi',
    ];

    /**
     * Relasi ke model Kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'Kategori_ID', 'id');
    }
}
