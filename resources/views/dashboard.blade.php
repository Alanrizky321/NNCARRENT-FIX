<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>NNCARRENT - Rental Mobil Terpercaya</title>
      <link rel="icon" type="image/png" href="{{ asset('images/web.png') }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }

    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>

<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <nav class="bg-gray-900 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="font-extrabold text-2xl text-red-500 select-none">
        NNCARRENT
      </div>
      <ul class="hidden md:flex space-x-8 text-sm font-medium">
        <li><a href="{{ route('home') }}" class="text-red-500 hover:text-red-400 transition-colors">Beranda</a></li>
        <li><a href="{{ route('tentangkami') }}" class="text-gray-300 hover:text-red-500 transition-colors">Tentang Kami</a></li>
        <li><a href="{{ route('kategori') }}" class="text-gray-300 hover:text-red-500 transition-colors">Daftar Mobil</a></li>
      </ul>

      <!-- User Menu with Alpine.js -->
      <div class="flex items-center space-x-3 relative" x-data="{ open: false }">
        @if (!Auth::guard('admin')->check() && !Auth::guard('pelanggan')->check())
        <!-- Jika belum login, tampilkan tombol Register dan Login -->
        <a href="{{ route('register') }}" class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded-lg transition-colors font-medium">
          Register
        </a>
        <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 text-white text-sm px-5 py-2 rounded-lg transition-colors font-medium shadow-md">
          Login
        </a>
        @else
        <!-- Jika sudah login, tampilkan email dan tombol Logout -->
        <button @click="open = !open" class="flex items-center space-x-3 bg-red-500 hover:bg-red-600 transition-colors rounded-lg px-4 py-2 focus:outline-none">
          <i class="fas fa-user-circle text-white text-xl"></i>
          <span class="text-white text-sm font-medium hidden md:inline">
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
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open"
          @click.away="open = false"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 transform scale-95"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-95"
          class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-xl z-50 overflow-hidden"
          style="display: none;">
          @if (Auth::guard('pelanggan')->check())
          <a href="{{ route('riwayat') }}"
            class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
            <i class="fas fa-clipboard-list text-gray-400"></i>
            <span>Detail Pemesanan</span>
          </a>
          @endif
          <div class="border-t border-gray-100"></div>
          <form action="{{ route('pelanggan.logout') }}" method="POST" @if (Auth::guard('admin')->check()) action="{{ route('admin.logout') }}" @endif>
            @csrf
            <button type="submit"
              class="w-full flex items-center space-x-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="relative bg-cover bg-center" style="background-image: url('https://storage.googleapis.com/a1aa/image/12546588-d059-45db-d363-c55f4aceba90.jpg'); height: 500px;">
    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>
    <div class="relative h-full flex flex-col justify-center px-6 md:px-12 max-w-7xl mx-auto text-white">
      <h1 class="font-bold text-4xl md:text-5xl max-w-2xl leading-tight mb-6">
        Nikmati Perjalanan Anda<br />
        dengan <span class="text-red-500">NNCARRENT</span> Hari Ini!
      </h1>
      <p class="max-w-xl text-base leading-relaxed mb-8 text-gray-200">
        Temukan kebebasan di jalan terbuka dengan beragam armada mobil sewaan kami.
        Apakah Anda membutuhkan mobil kompak untuk berkendara di dalam kota atau SUV yang luas untuk perjalanan keluarga, kami memiliki kendaraan yang tepat untuk Anda.
      </p>
      <a href="{{ route('kategori') }}" class="inline-flex items-center space-x-2 bg-red-500 hover:bg-red-600 transition-all duration-300 rounded-lg px-8 py-3 text-sm font-semibold shadow-lg hover:shadow-xl w-fit">
        <span>Pesan Sekarang</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </section>

  <!-- Popular Cars Section -->
  <section class="max-w-7xl mx-auto px-6 py-12">
    <div class="text-center mb-12">
      <h2 class="font-bold text-3xl mb-3 text-gray-900">Mobil Populer</h2>
      <p class="text-gray-600">Temukan mobil terbaik untuk perjalanan Anda</p>
    </div>

    <div class="relative">
      <button id="prevCar" aria-label="Previous car" class="absolute -left-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 z-20 transition-all shadow-lg">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div id="carSlider" class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory pb-4">
        @foreach ($mobils->take(6) as $mobil)
        <article class="min-w-[300px] snap-center flex-shrink-0 group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
          <!-- Car Image -->
          <div class="bg-gray-50 p-4 h-40 flex items-center justify-center overflow-hidden">
            <img src="{{ asset($mobil->Foto) }}"
              alt="{{ $mobil->Merek }} {{ $mobil->Model }}"
              class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
          </div>

          <!-- Car Details -->
          <div class="p-4">
            <!-- Title -->
            <h3 class="font-bold text-lg text-gray-900 mb-1">
              {{ $mobil->Merek }} <span class="font-extrabold">{{ $mobil->Model }}</span>
            </h3>
            <p class="text-sm text-gray-500 mb-2">({{ $mobil->Tahun }})</p>

            <!-- Price -->
            <div class="mb-3 pb-3 border-b border-gray-100">
              <p class="text-sm text-gray-600 mb-1">Harga Sewa</p>
              <p class="text-xl font-bold text-red-500">
                Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}
                <span class="text-sm font-normal text-gray-600">/hari</span>
              </p>
            </div>

            <!-- Specifications -->
            <div class="space-y-2 mb-3">
              <div class="flex items-center justify-between text-sm">
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-users w-4"></i>
                  <span>{{ $mobil->Jumlah_Kursi }} Kursi</span>
                </div>
                <div class="flex items-center space-x-1 text-gray-600">
                  <i class="fas fa-cog w-4"></i>
                  <span>{{ $mobil->Jenis_Transmisi }}</span>
                </div>
              </div>
              <div class="flex items-center space-x-1 text-sm">
                <i class="fas fa-tag text-gray-600 w-4"></i>
                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                  {{ $mobil->kategori->Nama_Kategori ?? 'Kategori tidak tersedia' }}
                </span>
              </div>
              <div class="flex items-center space-x-1 text-sm">
                @if($mobil->Status_Ketersediaan)
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="text-green-600 font-medium">Tersedia</span>
                @else
                <i class="fas fa-times-circle text-red-500"></i>
                <span class="text-red-600 font-medium">Tidak Tersedia</span>
                @endif
              </div>
            </div>

            <!-- Action Button -->
            <a href="{{ route('detail', ['id' => $mobil->ID_Mobil]) }}"
              class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-lg font-semibold transition-colors shadow-md hover:shadow-lg text-sm">
              Pesan Sekarang
            </a>
          </div>
        </article>
        @endforeach
      </div>

      <button id="nextCar" aria-label="Next car" class="absolute -right-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 z-20 transition-all shadow-lg">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </section>

  <!-- Informasi Wisata -->
  <section class="bg-gradient-to-br from-gray-900 to-gray-800 mt-24 py-16 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="font-bold text-3xl text-white mb-3">Informasi Wisata di Banyuwangi</h2>
        <p class="text-gray-300">Jelajahi destinasi wisata terbaik dengan kendaraan pilihan Anda</p>
      </div>

      <div class="relative">
        <button id="prevTour" aria-label="Previous tour" class="absolute -left-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 z-20 transition-all shadow-lg">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div id="tourSlider" class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory pb-4">
          <!-- Card 1 -->
        <div id="tourSlider" class="flex space-x-6 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory pb-4">
  <!-- Kawah Ijen -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="{{ asset('storage\destinasi_wisata\kawahijen.jpeg') }}" alt="Kawah Ijen" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Kawah Ijen</h3>
        <p class="text-gray-200 text-sm">Fenomena api biru yang memukau</p>
      </div>
    </div>
  </div>

  <!-- Pantai Pulau Merah -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="{{ asset('storage\destinasi_wisata\pulaumerah.jpg') }}" alt="Pantai Pulau Merah" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Pantai Pulau Merah</h3>
        <p class="text-gray-200 text-sm">Surga peselancar dengan pemandangan eksotis</p>
      </div>
    </div>
  </div>

  <!-- Alas Purwo -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="{{ asset('storage\destinasi_wisata\alaspurwo.jpeg') }}" alt="Alas Purwo" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Alas Purwo</h3>
        <p class="text-gray-200 text-sm">Hutan tropis penuh misteri dan spiritualitas</p>
      </div>
    </div>
  </div>

  <!-- Baluran -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="baluran.jpg" alt="Baluran" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Taman Nasional Baluran</h3>
        <p class="text-gray-200 text-sm">Afrika van Java dengan padang savana luas</p>
      </div>
    </div>
  </div>

  <!-- Green Bay -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="greenbay.jpg" alt="Green Bay" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Green Bay (Teluk Hijau)</h3>
        <p class="text-gray-200 text-sm">Pantai dengan air hijau zamrud dan pasir putih</p>
      </div>
    </div>
  </div>

  <!-- Pantai Sukamade -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="sukamade.jpg" alt="Pantai Sukamade" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Pantai Sukamade</h3>
        <p class="text-gray-200 text-sm">Habitat alami penyu hijau bertelur</p>
      </div>
    </div>
  </div>

  <!-- Pulau Tabuhan -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="tabuhan.jpg" alt="Pulau Tabuhan" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Pulau Tabuhan</h3>
        <p class="text-gray-200 text-sm">Pulau mungil dengan spot snorkeling dan pasir putih</p>
      </div>
    </div>
  </div>

  <!-- Watu Dodol -->
  <div class="min-w-[320px] snap-center flex-shrink-0 group">
    <div class="relative overflow-hidden rounded-xl shadow-lg">
      <img src="watudodol.jpg" alt="Watu Dodol" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 p-6">
        <h3 class="text-white font-bold text-xl mb-2">Watu Dodol</h3>
        <p class="text-gray-200 text-sm">Gerbang wisata ikonik Banyuwangi dengan batu legendaris</p>
      </div>
    </div>
  </div>
</div>

<!-- Tombol kanan -->
<button id="nextTour" aria-label="Next tour"
  class="absolute -right-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 z-20 transition-all shadow-lg">
  <i class="fas fa-chevron-right"></i>
</button>

  </section>
  <!-- Rating & Ulasan -->
  @if(auth()->check())
    <section id="rating-ulasan" class="max-w-7xl mx-auto mt-24 px-6">
      <!-- Header + Ringkasan -->
      <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
          <div>
            <h2 class="font-bold text-3xl text-gray-900">Rating & Ulasan</h2>
            <p class="text-gray-600 mt-1">
              Berdasarkan <span id="totalReviewsText" class="font-semibold text-red-500">{{ $dataRating->count() }}</span> ulasan
            </p>
          </div>

          <!-- Ringkasan skor -->
          <div class="flex items-center gap-6 bg-gray-50 p-4 rounded-lg shadow-inner">
            <div id="avgScore" class="text-5xl font-extrabold text-red-600">{{ number_format($medianRating, 1) }}</div>
            <div>
              <div id="avgStars" class="flex items-center gap-1 text-yellow-500 text-xl" aria-label="Skor rata-rata">
                @for ($i = 0; $i < $starnow; $i++)
                <i class="fas fa-star"></i>
                @endfor
                @for ($i = 0; $i < $emptystar; $i++)
                <i class="far fa-star"></i>
                @endfor
                {{-- <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> --}}
              </div>
              <p class="text-sm text-gray-500 mt-1">Skor rata-rata</p>
            </div>
          </div>
        </div>

        <!-- FORM: tepat di bawah ringkasan -->
        <div class="mt-8">
            <form action="{{ route('pelanggan.ulasan') }}" method="post">
                @csrf
                <div class="rounded-2xl border border-gray-100 p-6 bg-gradient-to-br from-white to-gray-50 shadow-md">
                    <h3 class="font-semibold text-xl text-gray-900 mb-4">Tulis Ulasan Anda</h3>
                    <p class="text-sm text-gray-600 mb-6">Bagikan pengalaman Anda untuk membantu pengguna lain.</p>

                    <!-- Rating Picker -->
                    <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">Pemberian Rating</label>
              <div id="starPicker" class="flex items-center gap-1" data-value="0" aria-label="Pilih rating 1–5">
                <i class="fas fa-star text-gray-300 cursor-pointer hover:text-yellow-500 transition-colors"></i>
                <i class="fas fa-star text-gray-300 cursor-pointer hover:text-yellow-500 transition-colors"></i>
                <i class="fas fa-star text-gray-300 cursor-pointer hover:text-yellow-500 transition-colors"></i>
                <i class="fas fa-star text-gray-300 cursor-pointer hover:text-yellow-500 transition-colors"></i>
                <i class="fas fa-star text-gray-300 cursor-pointer hover:text-yellow-500 transition-colors"></i>
              </div>
            </div>
            <input type="hidden" name="ratingBintang" id="ratingBintang">
            <script>
                 const ratingCount = document.getElementById("ratingBintang");
                 const starPicker = document.getElementById("starPicker");
                 const stars = starPicker.querySelectorAll(".fa-star");

                 let selectedValue = 0;

                 stars.forEach((star, index) => {
                     star.addEventListener("mouseover", () => {
                         stars.forEach((s, i) => {
                             s.classList.toggle("text-yellow-500", i <= index);
                       s.classList.toggle("text-gray-300", i > index);
                     });
                   });

                   star.addEventListener("mouseout", () => {
                     stars.forEach((s, i) => {
                       s.classList.toggle("text-yellow-500", i < selectedValue);
                       s.classList.toggle("text-gray-300", i >= selectedValue);
                    });
                });

                star.addEventListener("click", () => {
                    selectedValue = index + 1;
                    ratingCount.value = index + 1;
                    starPicker.setAttribute("data-value", selectedValue);
                    stars.forEach((s, i) => {
                        s.classList.toggle("text-yellow-500", i < selectedValue);
                           s.classList.toggle("text-gray-300", i >= selectedValue);
                        });
                        console.log(ratingCount.value);
                   });
                 });
                </script>

                <!-- Ulasan Textarea -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                    <textarea name="ulasan" id="rvText" rows="4" maxlength="500" class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 p-3 bg-white shadow-sm resize-none placeholder-gray-400" placeholder="Tulis ulasan Anda di sini…"></textarea>
                    <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                        <span id="rvCount">0</span>/500 karakter
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 text-right">
                    <button type="submit" id="rvSubmit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold text-sm px-6 py-2 rounded-lg shadow-md hover:shadow-lg transition-all">
                            Kirim Ulasan
                    </button>
                </div>
                @if(session()->has('kirimUlasanSuccess'))
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                  <div id="ulasanToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                        {{ session('kirimUlasanSuccess') }}
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>
                </div>
                <script>
                  document.addEventListener('DOMContentLoaded', function () {
                    var toastEl = document.getElementById('ulasanToast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                  });
                </script>
                @endif
                @if(session()->has('kirimUlasanFailed'))
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="ulasanToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Sebelum Memberikan Rating, Anda Harus Memesan terlebih dahulu.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var toastEl = document.getElementById('ulasanToast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    });
                </script>
            @endif
            @error('ratingBintang')
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="ulasanToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Terjadi kesalahan!, Bintang Tidak Boleh Kosong.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toastEl = document.getElementById('ulasanToast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            </script>
        @enderror
            @error('ulasan')
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="ulasanToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Terjadi kesalahan!, Ulasan Tidak Boleh Kosong.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toastEl = document.getElementById('ulasanToast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            </script>
        @enderrors
            </form>
          </div>
        </div>
      </div>
    </section>
  @endif
  <!-- Apa Kata Mereka — horizontal scroll + panah, TANPA JS -->
   <div class="mt-12 max-w-7xl mx-auto relative">
    <!-- Heading -->
    <div class="text-center mb-12">
      <h3 class="font-bold text-3xl text-gray-900 mb-3">Apa Kata Mereka</h3>
      <p class="text-gray-600 text-sm">Ulasan terbaru dari pelanggan kami</p>
      <div class="h-1 w-16 bg-red-500 mx-auto rounded-full mt-4"></div>
    </div>

    <!-- Panah (menggunakan button untuk scroll horizontal) -->
    @if ($dataRating->isNotEmpty())
    <button class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 -ml-2 z-20 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 shadow-lg transition-colors"
      aria-label="Sebelumnya" onclick="document.getElementById('reviewsTrack').scrollLeft -= 540">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 -mr-2 z-20 bg-white hover:bg-red-500 hover:text-white rounded-full p-3 shadow-lg transition-colors"
      aria-label="Berikutnya" onclick="document.getElementById('reviewsTrack').scrollLeft += 540">
      <i class="fas fa-chevron-right"></i>
    </button>
    @endif

    <!-- TRACK horizontal -->
    <div id="reviewsTrack"
      class="mt-6 grid grid-flow-col auto-cols-[minmax(540px,1fr)] overflow-x-auto snap-x snap-mandatory gap-6 w-full scroll-smooth scrollbar-hide px-1"
      style="scroll-behavior: smooth;">

      <!-- rev1 -->
      @if ($dataRating->isEmpty())
        <article id="rev1" class="snap-center rounded-2xl bg-white border border-gray-200 p-5 shadow-sm">
            <p>Whoopss, Data Tidak Tersedia...</p>
        </div>
      </article>
      @endif
      @foreach ( $dataRating as $rating )
      <article id="rev1" class="snap-center rounded-2xl bg-white border border-gray-200 p-5 shadow-sm">
        <div class="flex items-start gap-3">
        <div class="w-16 h-16 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold">BD</div>
          <div class="flex-1">
            <div class="flex items-center gap-3">
              <div class="text-amber-400">
                @for ($i = 0; $i < $rating->rating ; $i++)
                <i class="fas fa-star"></i>
                @endfor
                @for ($i = 0; $i < 5 - $rating->rating ; $i++)
                    <i class="far fa-star text-sm text-gray-300"></i>
                @endfor
                {{-- <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i>
                <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i> --}}
              </div>
              <span class="text-sm text-gray-500">{{ $rating->rating }}</span>
            </div>
            <p class="mt-1 text-gray-700">{{ $rating->ulasan }}</p>
          </div>
        </div>
      </article>
      @endforeach
    </div>
    <br>
    <!-- Dots -->
    @if ($dataRating->isNotEmpty())
    <div class="mt-4 flex items-center justify-center gap-2">
      <a href="#rev1" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
      <a href="#rev2" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
      <a href="#rev3" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
      <a href="#rev4" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
      <a href="#rev5" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
      <a href="#rev6" class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-red-500"></a>
    </div>
    @endif
  </div>

  <!-- Fitur Layanan -->
  <section class="bg-gray-50 mt-24 py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="font-bold text-3xl mb-3 text-gray-900">Mengapa Memilih Kami?</h2>
        <p class="text-gray-600">Keunggulan layanan yang kami tawarkan untuk Anda</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Feature 1 -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-100">
          <div class="w-14 h-14 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
            <i class="fas fa-car text-2xl text-blue-600"></i>
          </div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Armada Terawat</h4>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed">
            Servis berkala, interior disanitasi, inspeksi pra-jalan untuk setiap unit.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">MPV</span>
            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">City Car</span>
            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Premium</span>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-100">
          <div class="w-14 h-14 rounded-lg bg-yellow-100 flex items-center justify-center mb-4">
            <i class="fas fa-tag text-2xl text-yellow-600"></i>
          </div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Harga Transparan</h4>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed">
            Semua komponen biaya jelas sejak awal. Opsi pembayaran fleksibel & e-invoice.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Flat Rate</span>
            <span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Tanpa Hidden Fee</span>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-100">
          <div class="w-14 h-14 rounded-lg bg-green-100 flex items-center justify-center mb-4">
            <i class="fas fa-bolt text-2xl text-green-600"></i>
          </div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Proses Cepat</h4>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed">
            Form singkat via WA/website, konfirmasi instan, e-invoice otomatis.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Chat WhatsApp</span>
            <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Web Form</span>
          </div>
        </div>

        <!-- Feature 4 -->


        <!-- Feature 5 -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-100">
          <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-4">
            <i class="fas fa-shield-alt text-2xl text-pink-600"></i>
          </div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Asuransi & Keamanan</h4>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed">
            Asuransi standar + opsi upgrade. Unit tertentu dilengkapi GPS & dashcam.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-pink-50 text-pink-700 px-3 py-1 rounded-full text-xs font-medium">GPS</span>
            <span class="bg-pink-50 text-pink-700 px-3 py-1 rounded-full text-xs font-medium">Dashcam</span>
            <span class="bg-pink-50 text-pink-700 px-3 py-1 rounded-full text-xs font-medium">Insurance</span>
          </div>
        </div>

        <!-- Feature 6 -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-100">
          <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center mb-4">
            <i class="fas fa-headset text-2xl text-gray-700"></i>
          </div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Dukungan 24/7</h4>
          <p class="text-sm text-gray-600 mb-4 leading-relaxed">
            Tim support siap membantu perubahan jadwal, kendala teknis, keadaan darurat kapan pun.
          </p>
          <div class="flex flex-wrap gap-2">
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">Hotline</span>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">WhatsApp</span>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">Live Chat</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-12 mt-24">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <div>
          <h3 class="font-bold text-xl text-red-500 mb-4">NNCARRENT</h3>
          <p class="text-sm text-gray-400 leading-relaxed">
            Layanan rental mobil terpercaya untuk perjalanan Anda yang lebih nyaman.
          </p>
        </div>

        <div>
          <h4 class="font-semibold text-white mb-4">Menu</h4>
          <div class="flex flex-col space-y-2 text-sm">
            <a class="hover:text-red-500 transition-colors" href="{{ route('home') }}">Beranda</a>
            <a class="hover:text-red-500 transition-colors" href="{{ route('tentangkami') }}">Tentang Kami</a>
            <a class="hover:text-red-500 transition-colors" href="{{ route('kategori') }}">Daftar Mobil</a>
          </div>
        </div>

        <div>
          <h4 class="font-semibold text-white mb-4">Produk Kami</h4>
          <div class="flex flex-col space-y-2 text-sm">
            <a class="hover:text-red-500 transition-colors" href="{{ route('kategori') }}">Daftar Mobil</a>
          </div>
        </div>

        <div>
          <h4 class="font-semibold text-white mb-4">Ikuti Kami</h4>
          <div class="flex space-x-4">
            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-500 rounded-full flex items-center justify-center transition-colors">
              <i class="fab fa-instagram text-white"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-500 rounded-full flex items-center justify-center transition-colors">
              <i class="fab fa-facebook-f text-white"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
        <p>&copy; 2025 NNCARRENT. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- JavaScript for Sliders -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const prevCar = document.getElementById('prevCar');
      const nextCar = document.getElementById('nextCar');
      const carSlider = document.getElementById('carSlider');

      const prevTour = document.getElementById('prevTour');
      const nextTour = document.getElementById('nextTour');
      const tourSlider = document.getElementById('tourSlider');

      prevCar.addEventListener('click', () => {
        carSlider.scrollLeft -= 320;
      });

      nextCar.addEventListener('click', () => {
        carSlider.scrollLeft += 320;
      });

      prevTour.addEventListener('click', () => {
        tourSlider.scrollLeft -= 320;
      });

      nextTour.addEventListener('click', () => {
        tourSlider.scrollLeft += 320;
      });
    });
  </script>
</body>

</html>
