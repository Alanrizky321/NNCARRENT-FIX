<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Data Mobil</h2>

    <form action="{{ route('mobil.update', $mobil->ID_Mobil) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Merek</label>
            <input type="text" name="Merek" class="form-control" value="{{ old('Merek', $mobil->Merek) }}" required>
        </div>

        <div class="form-group">
            <label>Model</label>
            <input type="text" name="Model" class="form-control" value="{{ old('Model', $mobil->Model) }}" required>
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="Tahun" class="form-control" value="{{ old('Tahun', $mobil->Tahun) }}" required>
        </div>

        <div class="form-group">
            <label>Harga Sewa</label>
            <input type="number" name="Harga_Sewa" class="form-control" value="{{ old('Harga_Sewa', $mobil->Harga_Sewa) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="Foto" class="form-control-file">
            @if($mobil->Foto)
                <img src="{{ asset('storage/' . $mobil->Foto) }}" alt="Foto Mobil" class="img-fluid mt-2" style="max-width: 200px;">
            @endif
        </div>

        <div class="form-group">
            <label>Status Ketersediaan</label>
            <select name="Status_Ketersediaan" class="form-control" required>
                <option value="1" {{ $mobil->Status_Ketersediaan == 1 ? 'selected' : '' }}>Tersedia</option>
                <option value="0" {{ $mobil->Status_Ketersediaan == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="Kategori_ID" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori->id }}" {{ $mobil->Kategori_ID == $kategori->id ? 'selected' : '' }}>{{ $kategori->Nama_Kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>ID Admin</label>
            <input type="number" name="ID_Admin" class="form-control" value="{{ old('ID_Admin', $mobil->ID_Admin) }}" required>
        </div>

        <!-- Menambahkan kolom Jumlah Kursi -->
        <div class="form-group">
            <label>Jumlah Kursi</label>
            <input type="number" name="Jumlah_Kursi" class="form-control" value="{{ old('Jumlah_Kursi', $mobil->Jumlah_Kursi) }}" required>
        </div>

        <!-- Menambahkan kolom Jenis Transmisi -->
        <div class="form-group">
            <label>Jenis Transmisi</label>
            <select name="Jenis_Transmisi" class="form-control" required>
                <option value="manual" {{ $mobil->Jenis_Transmisi == 'manual' ? 'selected' : '' }}>Manual</option>
                <option value="automatic" {{ $mobil->Jenis_Transmisi == 'automatic' ? 'selected' : '' }}>Automatic</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('daftarmobiladmin') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
