<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>NNCarRent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <style>
    html, body { height: 100%; }
    body { font-family: "Inter", sans-serif; display: flex; flex-direction: column; }
    main { flex: 1; }
</style>

</head>
<body class="bg-white text-gray-900">
<header class="bg-gray-900 text-white">
    <nav class="bg-[#2a2727] flex items-center justify-between px-6 py-4">
        <div class="text-[#ff2a2a] font-extrabold text-xl select-none">NNCARRENT</div>
        <ul class="flex space-x-6 text-white text-sm font-normal">
            <li class="cursor-pointer hover:underline"><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li class="cursor-pointer hover:underline"><a href="{{ route('tentangkami') }}">Tentang kami</a></li>
            <li class="cursor-pointer text-[#b96a6a] hover:underline">Daftar Mobil</li>
        </ul>
          </ul>
<div class="flex space-x-2 items-center">
  @if (Auth::guard('pelanggan')->check())
    <span class="text-white text-xs truncate max-w-[150px]">
      {{ Auth::guard('pelanggan')->user()->email }}
    </span>
    <form action="{{ route('pelanggan.logout') }}" method="POST">
      @csrf
      <button type="submit" class="bg-[#f44343] text-white text-xs px-4 py-1 rounded-md hover:bg-[#e03e3e] transition-colors duration-300">
        Logout
      </button>
    </form>
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

<section class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-12 space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-8 text-xs sm:text-sm text-gray-900 font-normal relative">
            <button aria-current="page" class="text-red-400 font-normal focus:outline-none">Daftar Mobil</button>

            <div class="relative">
                <button id="sortButton" class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
                    <span>Harga</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div id="sortMenu" class="hidden absolute bg-white shadow rounded mt-2 py-1 w-32 z-10">
                    <a href="?sort=asc" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Termurah</a>
                    <a href="?sort=desc" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Termahal</a>
                </div>
            </div>

            <div class="relative">
    <button id="jenisButton" class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
        <span>Jenis</span>
        <i class="fas fa-chevron-down text-xs"></i>
    </button>
    <div id="jenisMenu" class="hidden absolute bg-white shadow rounded mt-2 py-1 w-32 z-10">
        <a href="?kategori=SUV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">SUV</a>
        <a href="?kategori=MPV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">MPV</a>
        <a href="?kategori=SUV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sedan</a>
        <a href="?kategori=MPV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hatchback</a>
        <a href="?kategori=MPV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Minibus</a>
        <a href="?kategori=SUV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Transmisi Manual</a>
        <a href="?kategori=MPV" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Transmisi Automatic</a>
    </div>
</div>

        <form class="ml-auto w-full sm:w-auto">
            <label class="sr-only" for="search">Search</label>
            <div class="relative text-gray-400 focus-within:text-gray-600 w-full sm:w-64">
                <input class="block w-full bg-gray-100 rounded-md py-2 pl-4 pr-10 text-xs sm:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:bg-white" id="search" name="search" placeholder="Search" type="search" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>
        </form>
    </div>
    <hr class="mt-6 border-t border-gray-300" />
</section>

<main class="max-w-7xl mx-auto px-6 pb-20">
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10 max-h-[600px] overflow-y-scroll pr-4">

@foreach ($mobils as $mobil)
<article class="flex space-x-6 bg-white p-6 rounded-md shadow-md border border-transparent hover:border-gray-200">
    <img src="{{ asset($mobil->Foto) }}" alt="{{ $mobil->Merek }}" class="w-[150px] h-[80px] object-contain flex-shrink-0">
    <div class="flex flex-col justify-between text-xs sm:text-sm">
        <div>
            <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ $mobil->Merek }} <span class="font-extrabold">{{ $mobil->Model }}</span><span class="text-gray-500 font-normal">({{ $mobil->Tahun }})</span></h3>
           
            <p class="mt-1 text-red-600 font-semibold text-xs sm:text-sm">RP {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }} <span class="font-normal text-gray-900">/hari</span></p>
            
            <div class="flex items-center space-x-4 mt-2 text-gray-500">
                <div class="flex items-center space-x-1">
                    <i class="fas fa-user"></i>
                    <span>{{ $mobil->Jumlah_Kursi }} </span>
                </div>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-cog"></i>
                    <span>{{ $mobil->Jenis_Transmisi }}</span>
                </div>
            </div>
            
            <div class="mt-2 flex items-center space-x-1 text-gray-500">
                <i class="fas fa-tag"></i>
                <span>{{ $mobil->kategori->Nama_Kategori ?? 'Kategori tidak tersedia' }}</span>
            </div>
            
            <p class="mt-2 text-gray-400 text-xs sm:text-sm">
                <i class="fas fa-{{ $mobil->Status_Ketersediaan ? 'check-circle text-green-500' : 'times-circle text-red-500' }}"></i>
                {{ $mobil->Status_Ketersediaan ? 'Tersedia' : 'Tidak Tersedia' }}
            </p>
        </div>
        
        <a href="{{ route('detail', ['id' => $mobil->ID_Mobil]) }}" class="btn btn-primary">
       
            <button class="bg-red-600 text-white text-xs sm:text-sm px-4 py-1 rounded shadow-md hover:bg-red-500 transition duration-200">Pesan Sekarang</button>
        </a>
    </div>
</article>
@endforeach

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
            <img src="web.jpg" alt="Logo" class="h-10 object-contain" width="120" />
        </div>
    </div>
</footer>

<script>
document.getElementById('sortButton').addEventListener('click', function () {
    var menu = document.getElementById('sortMenu');
    menu.classList.toggle('hidden');
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Untuk dropdown Jenis
    const jenisButton = document.getElementById('jenisButton');
    const jenisMenu = document.getElementById('jenisMenu');
    
    jenisButton.addEventListener('click', function(e) {
        e.stopPropagation(); // Mencegah event bubble
        jenisMenu.classList.toggle('hidden');
    });

    // Untuk menutup dropdown saat klik di luar
    document.addEventListener('click', function() {
        jenisMenu.classList.add('hidden');
    });

    // Mencegah dropdown tertutup saat mengklik menu itu sendiri
    jenisMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
</body>
</html>
