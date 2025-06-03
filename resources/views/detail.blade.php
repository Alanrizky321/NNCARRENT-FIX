<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Toyota Alpard Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        /* Custom star color for rating */
        .star-yellow {
            color: #fbbf24;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<a href="{{ route('kategori') }}" class="fixed top-4 left-4 text-red-600 hover:text-red-800 inline-flex items-center z-50">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Kategori
    </a>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Detail Mobil -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <img src="{{ asset($mobil->Foto) }}" alt="{{ $mobil->Merek }}" class="w-full md:w-1/2 h-auto rounded-lg">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">
                            {{ $mobil->Merek }} {{ $mobil->Model }} <span class="text-gray-500">({{ $mobil->Tahun }})</span>
                        </h1>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave text-gray-500 mr-2"></i>
                                <span class="font-semibold text-red-600">Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }} /hari</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-gray-500 mr-2"></i>
                                <span>{{ $mobil->Jumlah_Kursi }} Kursi</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-cog text-gray-500 mr-2"></i>
                                <span>{{ ucfirst($mobil->Jenis_Transmisi) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag text-gray-500 mr-2"></i>
                                <span>{{ $mobil->kategori->Nama_Kategori ?? '-' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-{{ $mobil->Status_Ketersediaan ? 'check text-green-500' : 'times text-red-500' }} mr-2"></i>
                                <span>{{ $mobil->Status_Ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian & Total Bayar -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-bold mb-4">Rincian</h2>
                <form action="{{ route('booking.create', $mobil->ID_Mobil) }}" method="GET">
                    @csrf
                    <input type="hidden" name="mobil_id" value="{{ $mobil->ID_Mobil }}">
                    <div class="mb-4 space-y-2">
                        <div class="flex justify-between">
                            <span>Harga Sewa per hari</span>
                            <span>Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-semibold text-red-600">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                        Lanjutkan Pemesanan
                        <form action="{{ route('datadiri.create', $mobil->ID_Mobil) }}" method="GET">

                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Kebijakan Rental -->
    <div class="mt-8 max-w-md">
        <div class="text-[11px] font-semibold mb-1">Kebijakan Rental</div>
        <div class="text-[11px] flex items-center gap-1 mb-0.5">
            <span class="text-[#d33c3c] text-[10px] font-bold">●</span>
            <span>Penggunaan hingga 24 Jam Per hari</span>
           
        </div>
        <div class="text-[10px] text-[#222222] ml-4 mb-4">
            Keterlambatan lebih dari 1 jam dikenai denda sesuai ketentuan yang berlaku.
        </div>
    </div>

    <!-- Info Penting -->
    <div class="mt-8 max-w-md">
        <div class="text-[11px] font-semibold mb-1">Info Penting</div>
        <ul class="text-[10px] text-[#222222] ml-4 list-disc space-y-1">
            <li>Pastikan untuk membaca semua persyaratan sewa</li>
            <li>Saat Anda bertemu dengan staf penyewaan, periksa kondisi mobil bersama staf tersebut</li>
            <li>Bawa kartu identitas, SIM, dan dokumen lainnya sebagaimana diharuskan oleh penyedia penyewaan.</li>
        </ul>
    </div>

    <!-- Review -->
    <div class="mt-8 max-w-md">
        <h3 class="font-semibold text-[13px] mb-4">Review</h3>
        <div class="flex flex-col gap-6">
            <div class="flex gap-3">
                <div class="flex flex-col items-center justify-center text-[14px] text-[#222222]">
                    <i class="far fa-user-circle text-[20px]"></i>
                    <span class="text-[11px] mt-1">octahyt@gmail.com</span>
                </div>
                <div class="flex flex-col gap-1 text-[11px] text-[#222222]">
                    <div class="star-yellow">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p class="text-[10px]">Sangat puas dengan layanannya! Websitenya mudah digunakan, mobil datang tepat waktu dan dalam kondisi bersih. Terima kasih!</p>
                </div>
            </div>
            <!-- Tambahkan review lain sesuai data -->
        </div>
    </div>

    <!-- Rincian Harga (Footer) -->
    
@endsection

</body>
</html>
