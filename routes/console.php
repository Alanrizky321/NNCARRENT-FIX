<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\Laporan;
use App\Models\Pesan;
use Carbon\Carbon;


Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// *** Scope untuk cek tanggal kadaluarsa pemesanan ***
// Schedule::call(function () {
//     DB::table('pesans')
//         ->where('tanggal_selesai', '<', now())
//         ->where('status', 'on_going')
//         ->update(['status' => 'finished']);
// })->everySecond();
Schedule::call(function () {
    DB::table('pesans')
        ->where('tanggal_selesai', '>=', now())
        ->where('status', 'on_going')
        ->update(['status' => 'finished']);
})->everySecond();
Schedule::call(function () {
    $pesanans = Pesan::where('status', 'finished')->where('tanggal_selesai', '<=', Carbon::now()->subWeek())->get();
    $totalRekap = $pesanans->sum('total_harga');
    $laporanBaru = Laporan::create([
        'tanggal_laporan' => Carbon::now(),
        'jenis_laporan' => 'Mingguan',
        'total' => $totalRekap,
        'deskripsi' => 'Rekapan Selama Seminggu',
    ]);
    foreach ($pesanans as $pesanan) {
        $pesanan->update([
            'status' => 'archived',
            'laporan_id' => $laporanBaru->id
        ]);
    }
})->weekly();
