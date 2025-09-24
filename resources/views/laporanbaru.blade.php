<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Laporan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white p-6">
    <div class="max-w-4xl mx-auto rounded-lg border border-gray-200">
        <div class="bg-gray-50 rounded-t-lg px-6 py-3">
            <h2 class="italic font-semibold text-gray-900 text-lg">Tambah Laporan Baru</h2>
        </div>
        <form action="{{ route('laporan.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="tanggal" class="block text-gray-900 font-semibold italic text-sm mb-1">Tanggal Laporan</label>
                    <div class="relative">
                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        />
                        @error('tanggal')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="jenis" class="block text-gray-900 font-semibold italic text-sm mb-1">Jenis Laporan</label>
                    <div class="relative">
                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                        >
                            <option value="" {{ old('jenis') ? '' : 'selected' }} disabled>Pilih jenis laporan</option>
                            <option value="mingguan" {{ old('jenis') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                            <option value="bulanan" {{ old('jenis') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ old('jenis') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                        <span class="absolute inset-y-0 right-3 flex items-center text-gray-400 pointer-events-none">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        @error('jenis')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="total" class="block text-gray-900 font-semibold italic text-sm mb-1">Total (Rp)</label>
                    <input
                        type="number"
                        id="total"
                        name="total"
                        step="0.01"
                        value="{{ old('total') }}"
                        placeholder="0.00"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                    />
                    @error('total')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="deskripsi" class="block text-gray-900 font-semibold italic text-sm mb-1">Deskripsi</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        placeholder="Masukkan deskripsi laporan"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-500 placeholder-gray-400 resize-none focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex space-x-6 pt-2">
                <a
                    href="{{ route('laporan.index') }}"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold italic text-sm rounded-md px-8 py-2"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold italic text-sm rounded-md px-8 py-2"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>
</html>