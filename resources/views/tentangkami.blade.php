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
    Dengan semangat dan komitmen yang tinggi untuk mengutamakan kepuasan konsumen di bidang jasa sewa mobil lepas kunci untuk membantu pengalamamn anda menikmati kawasan eksotis di Banyuwangi.
    Dengan pengalaman lebih dari 5 tahun di bidang jasa sewa mobil, tour and travel tentu kami bisa menjadi partner terbaik untuk perjalanan Anda. Perusahaan ini dalam setiap layanannya selalu mengutamakan kepuasan konsumen. Oleh sebab itu, kami selalu menyediakan armada terbaru yang bersih dan terawat.
  </main>
 </body>
</html>
