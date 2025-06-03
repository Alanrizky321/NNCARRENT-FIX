<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Konfirmasi Pesanan - NNCARRENT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-700">
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-[#FF2E2E] mb-6">Konfirmasi Pesanan Anda</h1>

        <div class="bg-gray-100 rounded-lg p-6 shadow-md">
            <p><strong>Nama Pelanggan:</strong> {{ $pesan->nama_pelanggan }}</p>
            <p><strong>Nomor HP:</strong> {{ $pesan->nomor_hp }}</p>
            <p><strong>Email:</strong> {{ $pesan->email }}</p>
            <p><strong>Mobil:</strong> {{ $pesan->mobil->Merek ?? 'Tidak diketahui' }} {{ $pesan->mobil->Model ?? '' }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($pesan->tanggal_mulai)->format('d M Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($pesan->tanggal_selesai)->format('d M Y') }}</p>
            <p><strong>Metode Antar Jemput:</strong> 
                {{ $pesan->antar_jemput == 'antar-jemput' ? 'Antar Jemput' : 'Ambil di Garasi' }}</p>

            @if($pesan->antar_jemput == 'antar-jemput')
                <p><strong>Lokasi Antar:</strong> {{ $pesan->lokasi_antar ?? '-' }}</p>
                <p><strong>Lokasi Jemput:</strong> {{ $pesan->lokasi_jemput ?? '-' }}</p>
            @endif

            <p class="mt-4"><strong>Status Pesanan:</strong> 
                @if($pesan->status == 'pending')
                    <span class="text-yellow-500 font-semibold">Pending</span>
                @elseif($pesan->status == 'confirmed')
                    <span class="text-green-600 font-semibold">Dikonfirmasi</span>
                @elseif($pesan->status == 'rejected')
                    <span class="text-red-600 font-semibold">Ditolak</span>
                @else
                    <span>{{ ucfirst($pesan->status) }}</span>
                @endif
            </p>

            <p class="mt-4 text-sm text-gray-600">
                Dokumen KTP, SIM, dan Bukti Pembayaran Anda sedang dalam proses verifikasi oleh admin.
            </p>

            <div class="mt-6">
                <a href="{{ route('kategori') }}" class="text-[#FF2E2E] hover:underline font-semibold">
                    Kembali ke Daftar Mobil
                </a>
            </div>
        </div>
    </div>
</body>

</html>
