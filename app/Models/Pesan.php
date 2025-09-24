<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesan extends Model
{
    protected $table = 'pesans';

    protected $fillable = [
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_pelanggan',
        'nomor_hp',
        'email',
        'ktp_photo_path',
        'sim_photo_path',
        'bukti_pembayaran_path',
        'judul',
        'isi_pesan',
        'verification_status',
        'rejection_reason',
        'antar_jemput',
        'lokasi_antar',
        'lokasi_jemput',
        'status',
        'total_harga',
        'laporan_id',
        'reschedule_tanggal_mulai', // Tambahkan
        'reschedule_tanggal_selesai', // Tambahkan
        'reschedule_status', // Tambahkan
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id', 'ID_Mobil');
    }

    public function dataRekap(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id');
    }
}