<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NNCarRent About
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Poppins", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-black">
  <nav class="bg-[#2a2727] flex items-center justify-between px-6 py-4">
   <div class="text-[#ff2a2a] font-extrabold text-xl select-none">
    NNCARRENT
   </div>
   <ul class="flex space-x-6 text-white text-sm font-normal">
    <li class="cursor-pointer hover:underline">
    <a href="{{ route('dashboard') }}">Beranda</a>
    </li>
    <li class="cursor-pointer text-[#b96a6a] hover:underline">
     Tentang Kami
    </li>
    <li class="cursor-pointer hover:underline">
    <a href="{{ route('kategori') }}">Daftar Mobil</a>
    </li>
   </ul>
   <div class="flex items-center space-x-2 text-xs text-[#2a2727] cursor-default select-none">
    <i class="far fa-user text-black">
    </i>
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
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="bg-[#f44343] text-white text-xs px-4 py-1 rounded-md hover:bg-[#e03e3e] transition-colors duration-300">
        Logout
      </button>
    </form>
  @endif
</div>
   </div>
  </nav>
  <main class="max-w-5xl mx-auto px-6 py-12">
   <div class="flex justify-center mb-6">
   <img 
    alt="Logo NNFamily Trans Wisata with NN in black gradient and Family Trans Wisata in red" 
    class="h-28 object-contain" 
    height="120" 
    src="web.jpg" 
    width="200"
  />
   </div>
   <h2 class="text-center font-extrabold text-lg mb-10">
    Tentang NNCARRENT
   </h2>
   <p class="mb-10 text-sm leading-relaxed max-w-4xl mx-auto">
    <span class="font-extrabold text-[#ff2a2a]">
     NNCARRENT
    </span>
    Merupakan Perusahaan Jasa Sewa Mobil, Tour and Travel di Banyuwangi yang telah berdiri resmi di bawah naungan PT. NNFamily Trans Banyuwangi.
   </p>
   <p class="mb-10 text-sm leading-relaxed max-w-4xl mx-auto">
    Dengan semangat dan komitmen yang tinggi untuk mengutamakan kepuasan konsumen di bidang jasa sewa mobil, tour and travel. Perusahaan kami melayani jasa sewa mobil plus Driver Di samping itu, kami juga memberikan berbagai jenis layanan transportasi lainnya. Mulai dari Sewa mobil untuk keperluan pribadi mau pun kedinasan, travel antar kota antar propinsi hingga trip wisata
   </p>
   <p class="mb-10 text-sm leading-relaxed max-w-4xl mx-auto">
    Dengan pengalaman lebih dari 5 tahun di bidang jasa sewa mobil, tour and travel tentu kami bisa menjadi partner terbaik untuk perjalanan Anda. Perusahaan ini dalam setiap layanannya selalu mengutamakan kepuasan konsumen. Oleh sebab itu, kami selalu menyediakan armada terbaru yang bersih dan terawat. Driver yang tersedia di Perusahaan Kami juga merupakan Driver yang ramah, professional dan berpengalamana.
   </p>
  </main>
 </body>
</html>
