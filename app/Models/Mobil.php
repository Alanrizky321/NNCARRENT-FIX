<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mobil extends Model
{
    use SoftDeletes;

    protected $table = 'mobil';
    protected $primaryKey = 'ID_Mobil';


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