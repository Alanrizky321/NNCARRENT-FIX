@extends('layouts.app') {{-- Sesuaikan dengan nama layout Anda --}}

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold italic mb-6 text-gray-900">Detail Laporan</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="font-semibold italic text-sm text-gray-700">ID Laporan</p>
                <p class="text-gray-900">{{ $laporan->id }}</p>
            </div>
            <div>
                <p class="font-semibold italic text-sm text-gray-700">Tanggal Laporan</p>
                <p class="text-gray-900">{{ $laporan->tanggal_laporan->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="font-semibold italic text-sm text-gray-700">Jenis Laporan</p>
                <p class="text-gray-900">{{ ucfirst($laporan->jenis_laporan) }}</p>
            </div>
            <div>
                <p class="font-semibold italic text-sm text-gray-700">Total (Rp)</p>
                <p class="text-gray-900">Rp {{ number_format($laporan->total, 2, ',', '.') }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="font-semibold italic text-sm text-gray-700">Deskripsi</p>
                <p class="text-gray-900">{{ $laporan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('laporan.index') }}"
               class="bg-blue-600 text-white text-sm font-semibold italic rounded px-4 py-2 hover:bg-blue-700 transition">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection