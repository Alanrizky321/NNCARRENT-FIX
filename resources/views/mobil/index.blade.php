@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Mobil</h2>

    <a href="{{ route('mobil.create') }}" class="btn btn-primary mb-3">+ Tambah Mobil</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Merek</th>
                <th>Model</th>
                <th>Tahun</th>
                <th>Harga Sewa</th>
                <th>Status</th>
                <th>Jumlah Kursi</th> <!-- Kolom Jumlah Kursi -->
                <th>Jenis Transmisi</th> <!-- Kolom Jenis Transmisi -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mobils as $mobil)
            <tr @if($mobil->trashed()) style="background-color: #f8d7da;" @endif>
                <td>{{ $mobil->Merek }}</td>
                <td>{{ $mobil->Model }}</td>
                <td>{{ $mobil->Tahun }}</td>
                <td>Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</td>
                <td>{{ $mobil->Status_Ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                <td>{{ $mobil->Jumlah_Kursi }}</td> <!-- Menampilkan Jumlah Kursi -->
                <td>{{ ucfirst($mobil->Jenis_Transmisi) }}</td> <!-- Menampilkan Jenis Transmisi -->
                <td>
                    @if(!$mobil->trashed())
                        <a href="{{ route('mobil.edit', $mobil->ID_Mobil) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('mobil.destroy', $mobil->ID_Mobil) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    @else
                        <form action="{{ route('mobil.restore', $mobil->ID_Mobil) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-success btn-sm">Restore</button>
                        </form>

                        <form action="{{ route('mobil.forceDelete', $mobil->ID_Mobil) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-dark btn-sm" onclick="return confirm('Yakin hapus permanen?')">Force Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Data belum tersedia</td> <!-- Perbaiki jumlah kolom menjadi 8 -->
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
