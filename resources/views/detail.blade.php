<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        /* Custom star color for rating */
        .star-yellow {
            color: #fbbf24;
        }
        html, body { height: 100%; }
        body { font-family: "Inter", sans-serif; display: flex; flex-direction: column; }
        main { flex: 1; }
    </style>
</head>
<body class="bg-white text-gray-900">
<header class="bg-gray-900 text-white">
    <nav class="bg-[#2a2727] flex items-center justify-between px-6 py-4">
        <a href="{{ route('kategori') }}" class="text-[#ff2a2a] font-extrabold text-sm flex items-center space-x-2 hover:text-[#e03e3e] transition-colors duration-300">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Kategori</span>
        </a>
        <ul class="flex space-x-6 text-white text-sm font-normal">
            <li class="cursor-pointer hover:underline"><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li class="cursor-pointer hover:underline"><a href="{{ route('tentangkami') }}">Tentang kami</a></li>
            <li class="cursor-pointer text-[#b96a6a] hover:underline">Daftar Mobil</li>
        </ul>
       <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="flex items-center space-x-2 relative" x-data="{ open: false }">
  @if (Auth::guard('pelanggan')->check())
    <!-- Icon User -->
    <button @click="open = !open" class="text-white focus:outline-none">
      <i class="fas fa-user-circle text-2xl"></i>
    </button>

    <!-- Dropdown -->
    <div x-show="open" 
         @click.away="open = false" 
         class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50"
         x-transition>
      <a href="{{ route('riwayat') }}" 
         class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        Detail Pemesanan
      </a>
      <form action="{{ route('pelanggan.logout') }}" method="POST">
        @csrf
        <button type="submit" 
                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
          Logout
        </button>
      </form>
    </div>
  @else
    <a href="{{ route('register') }}" class="bg-gray-600 text-white text-xs px-3 py-1 rounded-md hover:bg-gray-700 transition-colors duration-300">
      Register
    </a>
    <a href="{{ route('login') }}" class="bg-[#f44343] text-white text-xs px-4 py-1 rounded-md hover:bg-[#e03e3e] transition-colors duration-300">
      Login
    </a>
  @endif
</div>
    </nav>
</header>

<!-- Rest of your original content remains unchanged -->
<main class="flex-1">
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
                    <form action="{{ Auth::guard('pelanggan')->check()
                            ? route('datadiri.create', $mobil->ID_Mobil)
                            : route('login') }}"
                        method="GET">
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
                        <button type="submit"
                            class="w-full py-2 rounded transition
                                {{ Auth::guard('pelanggan')->check()
                                    ? 'bg-red-600 text-white hover:bg-red-700'
                                    : 'bg-gray-400 text-gray-800 cursor-not-allowed' }}">
                            {{ Auth::guard('pelanggan')->check()
                                ? 'Lanjutkan Pemesanan'
                                : 'Login untuk Pesan' }}
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
                        
                    </div>
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-gray-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-4 gap-8 text-xs sm:text-sm">
        <div class="flex flex-col space-y-4">
            <a class="hover:underline" href="#">Beranda</a>
            <a class="hover:underline" href="#">Tentang Kami</a>
            <a class="hover:underline" href="#">Kontak</a>
        </div>
        <div class="flex flex-col space-y-2 max-w-[150px]">
            <span class="font-semibold">Produk kami</span>
            <a class="hover:underline" href="#">Mobil</a>
        </div>
        <div class="flex flex-col items-center space-y-2">
            <span>Ikuti medsos kami</span>
            <a aria-label="Instagram" class="hover:text-[#f44343]" href="#"><i class="fab fa-instagram text-lg"></i></a>
        </div>
        <div class="flex items-center">
            <img src="web.jpg" alt="Logo" class="h-10 object-contain"50px" />
        </div>
    </div>
</footer>
</body>
</html>