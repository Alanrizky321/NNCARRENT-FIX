<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Mobil</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                <h5 class="font-semibold mb-2">Terjadi Kesalahan!</h5>
                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium text-gray-700">Merek</label>
                <input type="text" name="Merek" value="{{ old('Merek') }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 @error('Merek') border-red-500 @enderror">
                @error('Merek')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700">Model</label>
                <input type="text" name="Model" value="{{ old('Model') }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 @error('Model') border-red-500 @enderror">
                @error('Model')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Tahun</label>
                    <input type="number" name="Tahun" value="{{ old('Tahun') }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 @error('Tahun') border-red-500 @enderror">
                    @error('Tahun')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Harga Sewa</label>
                    <input type="number" step="0.01" name="Harga_Sewa" value="{{ old('Harga_Sewa') }}" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 @error('Harga_Sewa') border-red-500 @enderror">
                    @error('Harga_Sewa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Foto</label>
                <input type="file" name="Foto" class="w-full px-2 py-1 border rounded-md @error('Foto') border-red-500 @enderror">
                @error('Foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Status Ketersediaan</label>
                    <select name="Status_Ketersediaan" required class="w-full px-4 py-2 border rounded-md @error('Status_Ketersediaan') border-red-500 @enderror">
                        <option value="1" {{ old('Status_Ketersediaan') == '1' ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ old('Status_Ketersediaan') == '0' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('Status_Ketersediaan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Kategori</label>
                    <select name="Kategori_ID" required class="w-full px-4 py-2 border rounded-md @error('Kategori_ID') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('Kategori_ID') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->Nama_Kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('Kategori_ID')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">ID Admin</label>
                    <input type="number" name="ID_Admin" value="{{ old('ID_Admin') }}" required class="w-full px-4 py-2 border rounded-md @error('ID_Admin') border-red-500 @enderror">
                    @error('ID_Admin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Jumlah Kursi</label>
                    <input type="number" name="Jumlah_Kursi" value="{{ old('Jumlah_Kursi') }}" required class="w-full px-4 py-2 border rounded-md @error('Jumlah_Kursi') border-red-500 @enderror">
                    @error('Jumlah_Kursi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Jenis Transmisi</label>
                <select name="Jenis_Transmisi" required class="w-full px-4 py-2 border rounded-md @error('Jenis_Transmisi') border-red-500 @enderror">
                    <option value="manual" {{ old('Jenis_Transmisi') == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatic" {{ old('Jenis_Transmisi') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                </select>
                @error('Jenis_Transmisi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="{{ route('daftarmobiladmin') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
