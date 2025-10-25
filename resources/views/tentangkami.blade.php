<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
  About Us
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" rel="stylesheet"/>
   <style>
    body {
      font-family: "Inter", sans-serif;
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
   
    </i>
      </ul><script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
  <main class="max-w-5xl mx-auto px-6 py-12">
   <div class="flex justify-center mb-6">
   <img src="{{ asset('storage/web.jpg') }}" alt="logo"
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
    Dengan semangat dan komitmen yang tinggi untuk mengutamakan kepuasan konsumen di bidang jasa sewa mobil lepas kunci untuk membantu pengalamamn anda menikmati kawasan eksotis di Banyuwangi.
    Dengan pengalaman lebih dari 5 tahun di bidang jasa sewa mobil, tour and travel tentu kami bisa menjadi partner terbaik untuk perjalanan Anda. Perusahaan ini dalam setiap layanannya selalu mengutamakan kepuasan konsumen. Oleh sebab itu, kami selalu menyediakan armada terbaru yang bersih dan terawat.
    
    <section id="lokasi" class="py-12 bg-gray-100">
  <div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4 text-center">Lokasi Kami</h2>
    <p class="text-center text-gray-600 mb-6">
      Kunjungi kantor kami di Banyuwangi untuk informasi lebih lanjut
    </p>

    <div class="flex justify-center">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.0168384755116!2d114.359112573733!3d-8.201057182259936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd145006e2aa36b%3A0xaee19c765e4bdfc9!2sRental%20Mobil%20NNFamily%20Trans%20Wisata!5e0!3m2!1sid!2sid!4v1760601477825!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        
        
    </div>
  </div>
</section>

 
 
  </main>
 </body>
</html>
