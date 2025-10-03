<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    protected $casts = [
    'tanggal_laporan' => 'date',
];

    protected $fillable = [
        'tanggal_laporan',
        'jenis_laporan',
        'total',
    ];

    public function dataRekap(): HasMany
    {
        return $this->HasMany(Pesan::class, 'laporan_id', 'id');
    }
}
