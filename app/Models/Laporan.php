<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $casts = [
    'tanggal_laporan' => 'date',
];

    protected $fillable = [
        'tanggal_laporan',
        'jenis_laporan',
        'total',
        'deskripsi', // jika ada
    ];
}
