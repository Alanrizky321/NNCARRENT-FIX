<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>NNCarRent</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
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

  

  <!-- Hero Section -->
  <section class="max-w-[900px] mx-auto px-6 text-center mt-12">
    <h1 class="font-semibold text-lg md:text-xl leading-tight">
      Nikmati Perjalanan Anda
      <br/>
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
    <img alt="Line of black cars parked under airport terminal roof with lights on" class="mt-8 rounded-md w-full object-cover" height="300" src="https://storage.googleapis.com/a1aa/image/12546588-d059-45db-d363-c55f4aceba90.jpg" width="900"/>
  </section>

  <!-- Section 2 -->
  <section class="bg-[#7a7575] mt-16 py-10 px-6 max-w-[1200px] mx-auto flex flex-col md:flex-row items-center md:items-start gap-6">
    <div class="text-white max-w-[480px] md:max-w-[600px]">
      <h2 class="font-normal text-base md:text-lg leading-snug mb-3">
        Temukan Pengalaman Sewa Mobil Terbaik
        <br/>
        dengan NNCARRENT Hari Ini!
      </h2>
      <p class="text-[9px] md:text-xs text-gray-200 leading-tight">
        Di NNCARRENT, kami menawarkan beragam pilihan kendaraan yang sesuai dengan
        setiap kebutuhan. Nikmati harga yang kompetitif dan layanan pelanggan yang
        tak tertandingi yang memastikan pengalaman sewa yang mulus
      </p>
    </div>
    <img alt="White Toyota Alphard parked on street in daylight with trees and buildings in background" class="rounded-md w-full max-w-[320px] object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/f92d4cb3-aa15-4eb7-1a3b-c8b14b160c32.jpg" width="320"/>
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
          <img alt="White Toyota Alphard side view car image" class="w-[120px] h-[60px] object-contain mb-3" height="60" src="https://storage.googleapis.com/a1aa/image/f03ee803-2ac7-4174-16bb-f39db0b0cd10.jpg" width="120"/>
          <h4 class="font-bold text-xs mb-1">
            Toyota Alpard
          </h4>
          <div class="flex items-center text-yellow-400 text-xs mb-1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span class="text-gray-500 ml-1">(20 Review)</span>
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
          <div class="text-[9px] text-gray-600">
            Automatic
          </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white text-black rounded-md shadow-md min-w-[280px] snap-center flex-shrink-0 p-4 border border-gray-200">
          <img alt="White Toyota Alphard side view car image" class="w-[120px] h-[60px] object-contain mb-3" height="60" src="https://storage.googleapis.com/a1aa/image/f03ee803-2ac7-4174-16bb-f39db0b0cd10.jpg" width="120"/>
          <h4 class="font-bold text-xs mb-1">
            Toyota Alpard
          </h4>
          <div class="flex items-center text-yellow-400 text-xs mb-1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span class="text-gray-500 ml-1">(20 Review)</span>
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
          <div class="text-[9px] text-gray-600">
            Manual
          </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white text-black rounded-md shadow-md min-w-[280px] snap-center flex-shrink-0 p-4 border border-gray-200">
          <img alt="White Toyota Alphard side view car image" class="w-[120px] h-[60px] object-contain mb-3" height="60" src="https://storage.googleapis.com/a1aa/image/f03ee803-2ac7-4174-16bb-f39db0b0cd10.jpg" width="120"/>
          <h4 class="font-bold text-xs mb-1">
            Toyota Alpard
          </h4>
          <div class="flex items-center text-yellow-400 text-xs mb-1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span class="text-gray-500 ml-1">(20 Review)</span>
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
          <div class="text-[9px] text-gray-600">
            Manual
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- WISATA DI Banyuwangi -->
  <section class="max-w-[1200px] mx-auto px-6 mt-16">
    <h3 class="text-center font-semibold text-base md:text-lg mb-8">
      Informasi wisata di Banyuwangi
    </h3>
    <div class="relative">
      <div class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory">
        <!-- Card 1 -->
        <div class="flex flex-col items-center">
          <img src="pm.jpg" alt="Pulau Merah" class="object-contain rounded-md" height="280" width="200"/>
          <p class="font-bold text-xs mb-4 mt-4 text-center">
            Pulau Merah
          </p>
        </div>
        <!-- Card 2 -->
        <div class="flex flex-col items-center">
          <img src="cacalan.jpg" alt="Pantai Cacalan" class="object-contain rounded-md" height="280" width="200"/>
          <p class="font-bold text-xs mb-4 mt-4 text-center">
            Pantai Cacalan
          </p>
        </div>
        <!-- Card 3 -->
        <div class="flex flex-col items-center">
          <img src="purwo.jpg" alt="Alas Purwo" class="object-contain rounded-md" height="280" width="200"/>
          <p class="font-bold text-xs mb-4 mt-4 text-center">
            Alas Purwo
          </p>
        </div>
        <!-- Card 4 -->
        <div class="flex flex-col items-center">
          <img src="ijen.jpg" alt="Kawah Ijen" class="object-contain rounded-md" height="280" width="200"/>
          <p class="font-bold text-xs mb-4 mt-4 text-center">
            Kawah Ijen
          </p>
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-8">
      <button class="bg-[#f44343] text-white text-xs px-6 py-1 rounded hover:bg-[#e03e3e] transition-colors duration-300">
        <a href="{{ route('wisata') }}">Lihat selengkapnya</a>
      </button>
    </div>
  </section>

  <!-- Section 4 -->
  <section class="bg-[#e6e6e6] mt-16 py-10 px-6 max-w-[1980px] mx-auto text-center text-black text-[10px] md:text-xs leading-tight">
    <div class="max-w-[900px] mx-auto">
      <h4 class="font-semibold mb-2">
        Sewa Mobil Tanpa Sopirr
      </h4>
      <p class="mb-4">
        Nikmati perjalanan yang lebih seru bersama keluarga atau kerabat dengan memilih
        transportasi yang tepat. Menyewa mobil bisa menjadi solusi terbaik untuk kenyamanan
        dan kemudahan mobilitas Anda. Kini, NNCARRENT menghadirkan layanan Sewa Mobil Tanpa
        Supir yang fleksibel dan praktis.
      </p>
      <p>
        Tersedia berbagai pilihan mobil berkualitas dengan harga yang transparan. Anda bisa
        menikmati layanan sewa mobil tanpa supir selama 24 jam melalui NNCARRENT. Pilihan
        ideal untuk perjalanan keluarga maupun keperluan bisnis agar semakin hemat waktu dan efisien.
      </p>
    </div>
    <div class="max-w-[900px] mx-auto mt-8 text-black text-[10px] md:text-xs leading-tight">
      <h4 class="font-semibold mb-2">
        Sewa Mobil Dengan Sopir
      </h4>
      <p>
        Kelancaran mobilitas menjadi hal utama saat bepergian. Jika Anda ingin menikmati
        perjalanan tanpa ribet saat mengeksplorasi berbagai destinasi wisata, layanan sewa
        mobil dengan supir adalah solusi yang ideal. Kini, berkat kemajuan teknologi digital,
        Anda dapat memesan layanan sewa mobil dengan supir secara praktis melalui NNCARRENT
      </p>
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
        <span>Ikuti medsos kami</span>
        <a aria-label="Instagram" class="hover:text-[#f44343]" href="#">
          <i class="fab fa-instagram text-lg"></i>
        </a>
      </div>
      <div class="flex items-center">
        <img src="web.jpg" alt="Logo" class="h-10 object-contain" height="40" width="120"/>
      </div>
    </div>
  </footer>

  <script>
    function scrollCars(direction) {
      const container = document.querySelector(
        "section:nth-of-type(3) > div.relative > div.flex"
      );
      if (!container) return;
      const scrollAmount = 300;
      container.scrollBy({ left: direction * scrollAmount, behavior: "smooth" });
    }
  </script>
</body>
</html>