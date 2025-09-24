@extends('layouts.app') {{-- Sesuaikan dengan nama layout Anda --}}

@section('content')
<style>
    /* Custom CSS untuk desain dengan tema merah */
    .report-container {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 48rem;
        margin: 2rem auto;
    }

    .report-title {
        color: #b91c1c; /* Merah tua */
        font-weight: 700;
        font-style: italic;
        font-size: 1.875rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .success-message {
        background-color: #dcfce7;
        color: #15803d;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .report-card {
        border: 1px solid #fee2e2; /* Merah sangat muda */
        border-radius: 8px;
        padding: 1.5rem;
        background-color: #fff1f2; /* Latar belakang merah sangat muda */
    }

    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .report-label {
        color: #7f1d1d; /* Merah gelap */
        font-weight: 600;
        font-style: italic;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .report-value {
        color: #1f2937; /* Abu-abu gelap */
        font-size: 1rem;
    }

    .back-button {
        display: inline-block;
        background-color: #dc2626; /* Merah cerah */
        color: #ffffff;
        font-weight: 600;
        font-style: italic;
        font-size: 0.875rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-top: 1.5rem;
    }

    .back-button:hover {
        background-color: #b91c1c; /* Merah lebih tua saat hover */
    }

    @media (max-width: 640px) {
        .report-container {
            padding: 1rem;
            margin: 1rem;
        }

        .report-title {
            font-size: 1.5rem;
        }

        .report-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="report-container">
    <h2 class="report-title">Detail Laporan</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="report-card">
        <div class="report-grid">
            <div>
                <p class="report-label">ID Laporan</p>
                <p class="report-value">{{ $laporan->id }}</p>
            </div>
            <div>
                <p class="report-label">Tanggal Laporan</p>
                <p class="report-value">{{ $laporan->tanggal_laporan->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="report-label">Jenis Laporan</p>
                <p class="report-value">{{ ucfirst($laporan->jenis_laporan) }}</p>
            </div>
            <div>
                <p class="report-label">Total (Rp)</p>
                <p class="report-value">Rp {{ number_format($laporan->total, 2, ',', '.') }}</p>
            </div>
            <div class="col-span-2">
                <p class="report-label">Deskripsi</p>
                <p class="report-value">{{ $laporan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>
        <div>
            <a href="{{ route('laporan.index') }}" class="back-button">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection