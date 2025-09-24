<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Konfirmasi Pesanan - NNCARRENT</title>
    <meta http-equiv="Cache-Control" content="no-store" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="output.css">
    <style>
        .confirmation-container {
            border: 5px solid #FF2E2E;
            border-radius: 10px;
            padding: 80px;
            position: relative;
            max-width: 400px;
            margin: 0 auto;
        }
        .confirmation-container::before,
        .confirmation-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #FF2E2E;
        }
        .confirmation-container::before {
            left: 20px;
        }
        .confirmation-container::after {
            right: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #FF2E2E;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .header h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4B5563;
            margin: 0;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
            font-size: 0.875rem;
        }
        .details strong {
            display: inline-block;
            width: 100px;
            font-weight: bold;
            color: #4B5563;
        }
        .status {
            margin-top: 20px;
        }
        .status span.custom-status {
            display: inline-block;
            text-xs rounded-full px-3 py-1 font-normal select-none;
        }
        .status span.custom-status.on-going {
            background-color: greenyellow;
            color: #6B21A8;
            font-style: italic;
            border-radius: 9999px;
        }
        .status span.custom-status.pending {
            background-color: #FEF3C7;
            color: #B45309;
            border-radius: 9999px;
        }
        .status span.custom-status.confirmed {
            background-color: #D1FAE5;
            color: #065F46;
            border-radius: 9999px;
        }
        .status span.custom-status.canceled {
            background-color: red;
            color: black;
            border-radius: 9999px;
        }
        .notes {
            margin-top: 20px;
            font-size: 0.75rem;
            color: #6B7280;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            color: #4B5563;
            font-weight: bold;
            text-decoration: none;
            background-color: #D1D5DB;
            padding: 8px 16px;
            border-radius: 4px;
        }
        .back-link a:hover {
            background-color: #9CA3AF;
        }
    </style>
</head>
<body class="bg-white text-gray-700">
    <div class="max-w-3xl mx-auto confirmation-container">
        <div class="header">
            <h1 class="text-3xl font-bold text-red-600 mb-6">NNCARRENT</h1>
            <h2 class="text-2xl font-semibold text-gray-800">Konfirmasi Pesanan</h2>
        </div>
        
        <div class="details">
            <p><strong>Nama</strong> {{ $pesan->nama_pelanggan }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Nomor Telepon</strong> {{ $pesan->nomor_hp }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Email</strong> {{ $pesan->email }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Mobil</strong> {{ $pesan->mobil->Merek ?? 'Tidak diketahui' }} {{ $pesan->mobil->Model ?? '' }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Tanggal Mulai</strong> {{ \Carbon\Carbon::parse($pesan->tanggal_mulai)->format('d M Y') }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Tanggal Selesai</strong> {{ \Carbon\Carbon::parse($pesan->tanggal_selesai)->format('d M Y') }}</p>
            <hr class="border-gray-300 my-2">
            <p><strong>Metode Antar Jemput</strong> 
                {{ $pesan->antar_jemput == 'antar-jemput' ? 'Antar Jemput' : 'Ambil di Garasi' }}</p>
            @if($pesan->antar_jemput == 'antar-jemput')
                <hr class="border-gray-300 my-2">
                <p><strong>Lokasi Antar</strong> {{ $pesan->lokasi_antar ?? '-' }}</p>
                <hr class="border-gray-300 my-2">
                <p><strong>Lokasi Jemput</strong> {{ $pesan->lokasi_jemput ?? '-' }}</p>
            @endif
            <div class="status mt-4">
                <p><strong>Status Pesanan:</strong> 
                    <span class="custom-status {{ $pesan->status == 'on_going' ? 'on-going' : 
                        ($pesan->status == 'confirmed' ? 'confirmed' : 
                        ($pesan->status == 'canceled' ? 'canceled' : 'pending')) }}">
                        {{ $pesan->status == 'on_going' ? 'Diterima' : ($pesan->status == 'canceled' ? 'Ditolak' : ucfirst(str_replace('_', ' ', $pesan->status))) }}
                    </span>
                </p>
            </div>
        </div>
        <div class="notes">
            <p>CATATAN :</p>
            @if($pesan->status == 'on_going')
                <p>Pesanan Anda telah diterima.</p>
                <p>Tim kami akan segera menghubungi Anda untuk proses selanjutnya.</p>
            @elseif($pesan->status == 'canceled')
                <p>Pesanan Anda ditolak.</p>
                <p>Tim akan menghubungi anda untuk informasi lebih lanjut.</p>
            @else
                <p>Pesanan sedang dalam status pengecekan.</p>
                <p>Tim kami akan menghubungi Anda untuk proses selanjutnya.</p>
            @endif
        </div>
        <div class="back-link">
            <a href="{{ route('kategori') }}" class="text-[#FF2E2E] hover:underline font-semibold">
                Kembali ke Daftar Mobil
            </a>
            
        </div>
    </div>
    <script>
        // Mencegah pengguna kembali ke halaman sebelumnya dengan tombol browser
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1); // Mengarahkan pengguna ke halaman saat ini jika mereka mencoba menekan tombol kembali
        };
    </script>
</body>
</html>