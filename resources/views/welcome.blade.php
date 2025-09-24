<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>NNCarRent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-white text-black">
    <!-- Navbar -->
    <nav class="bg-[#2a2727] flex items-center justify-between px-6 py-4">
        <div class="text-[#ff2a2a] font-extrabold text-xl select-none">
            NNCARRENT
        </div>
        <ul class="flex space-x-6 text-white text-sm font-normal">
            <li class="cursor-pointer text-[#b96a6a] hover:underline">
                <a href="#">Beranda</a>
            </li>
            <li class="cursor-pointer hover:underline">
                <a href="{{ route('tentangkami') }}">Tentang Kami</a>
            </li>
            <li>
                <a href="{{ route('kategori') }}" class="cursor-pointer hover:underline">Daftar Mobil</a>
            </li>
        </ul>

           </ul>
<div class="flex space-x-2 items-center">
  @if (!Auth::guard('admin')->check() && !Auth::guard('pelanggan')->check())
    <!-- Jika belum login, tampilkan tombol Register dan Login -->
    <a href="{{ route('register') }}" class="bg-gray-600 text-white text-xs px-3 py-1 rounded-md hover:bg-gray-700 transition-colors duration-300">
      Register
    </a>
    <a href="{{ route('login') }}" class="bg-[#f44343] text-white text-xs px-4 py-1 rounded-md hover:bg-[#e03e3e] transition-colors duration-300">
      Login
    </a>
  @else
    <!-- Debug untuk memastikan guard aktif -->

    <!-- Jika sudah login, tampilkan email dan tombol Logout -->
    <span class="text-white text-xs truncate max-w-[150px]">
      @php
          $user = null;
          if (Auth::guard('admin')->check()) {
              $user = Auth::guard('admin')->user();
          } elseif (Auth::guard('pelanggan')->check()) {
              $user = Auth::guard('pelanggan')->user();
          }
          echo $user ? ($user->email ?? 'Email Tidak Ditemukan') : 'Pengguna Tidak Ditemukan';
      @endphp
    </span>
    <form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 text-left">
        <i class="fas fa-sign-out-alt text-lg"></i>
        <span>Logout</span>
    </button>
</form>

  @endif
</div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-[900px] mx-auto px-6 text-center mt-12">
        <h1 class="font-semibold text-lg md:text-xl leading-tight">
            Nikmati Perjalanan Anda
            <br />
            dengan NNCARRENT HARI INI!
        </h1>
        <p class="text-[10px] md:text-xs text-black-300 mt-3 max-w-[600px] mx-auto leading-tight">
            Temukan kebebasan di jalan terbuka dengan beragam armada mobil sewaan kami.
            Apakah Anda membutuhkan mobil kompak untuk berkendara di dalam kota atau SUV
            yang luas untuk perjalanan keluarga, kami memiliki kendaraan yang tepat untuk Anda.
        </p>
        <button class="bg-[#f44343] text-white text-xs px-4 py-1 rounded mt-6 hover:bg-[#e03e3e] transition-colors duration-300">
            <a href="{{ route('kategori') }}">Pesan sekarang</a>
        </button>
        <img alt="Line of black cars parked under airport terminal roof with lights on" class="mt-8 rounded-md w-full object-cover" height="300" src="https://storage.googleapis.com/a1aa/image/12546588-d059-45db-d363-c55f4aceba90.jpg" width="900" />
    </section>

    <!-- Section 2 -->
    <section class="bg-[#7a7575] mt-16 py-10 px-6 max-w-[1200px] mx-auto flex flex-col md:flex-row items-center md:items-start gap-6">
        <div class="text-white max-w-[480px] md:max-w-[600px]">
            <h2 class="font-normal text-base md:text-lg leading-snug mb-3">
                Temukan Pengalaman Sewa Mobil Terbaik
                <br />
                dengan NNCARRENT Hari Ini!
            </h2>
            <p class="text-[9px] md:text-xs text-gray-200 leading-tight">
                Di NNCARRENT, kami menawarkan beragam pilihan kendaraan yang sesuai dengan
                setiap kebutuhan. Nikmati harga yang kompetitif dan layanan pelanggan yang
                tak tertandingi yang memastikan pengalaman sewa yang mulus
            </p>
        </div>
        <img alt="White Toyota Alphard parked on street in daylight with trees and buildings in background" class="rounded-md w-full max-w-[320px] object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/f92d4cb3-aa15-4eb7-1a3b-c8b14b160c32.jpg" width="320" />
    </section>

    <!-- Section 3 -->
    <section class="max-w-[1200px] mx-auto px-6 mt-16">
        <h3 class="text-center font-semibold text-base md:text-lg mb-8">
            Pilihan Mobil terlaris
        </h3>
        <div class="relative">
            <div class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory">
                <!-- Card 1 -->
                <div class="bg-white text-black rounded-md shadow-md min-w-[280px] snap-center flex-shrink-0 p-4 border border-gray-200">
                    <img alt="White Toyota Alphard side view car image" class="w-[120px] h-[60px] object-contain mb-3" height="60" src="https://storage.googleapis.com/a1aa/image/f03ee803-2ac7-4174-16bb-f39db0b0cd10.jpg" width="120" />
                    <h4 class="font-bold text-xs mb-1">
                        Toyota Alpard
                    </h4>
                    <div class="flex items-center text-yellow-400 text-xs mb-1">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <i class="far fa-star"></i>
                        <span class="text-gray-500 ml-1">
                            (20 Review)
                        </span>
                    </div>
                    <div class="text-xs font-semibold text-[#f44343] mb-1">
                        RP 300.000
                        <span class="font-normal text-gray-700">/hari</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-[9px] space-x-3 mb-1">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-user"></i>
                            <span>6</span>
                        </div>
                        <div>MPV</div>
                    </div>
                    <div class="text-[9px] text-gray-600">Automatic</div>
                </div>
                <!-- More Cards -->
            </div>
        </div>
    </section>

    <!-- Footer -->
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
                <span>ikuti medsos kami</span>
                <a aria-label="Instagram" class="hover:text-[#f44343]" href="#">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
            </div>
            <div class="flex items-center">
                <img src="web.jpg" alt="Logo" class="logo" height="40" width="120" />
            </div>
        </div>
    </footer>
</body>

</html>
