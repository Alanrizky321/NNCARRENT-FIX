<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NNCARRENT Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-white text-gray-900">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-56 bg-white border-r border-gray-200 flex flex-col px-6 py-8">
      <div class="mb-12">
        <h1 class="text-2xl font-extrabold italic text-red-500 select-none">NNCARRENT</h1>
      </div>
      <nav class="flex flex-col space-y-6 text-gray-900 text-sm font-normal">
        <a href="#" class="flex items-center space-x-3 bg-red-500 text-white rounded-lg px-5 py-3 font-medium select-none">
          <i class="fas fa-th-large text-lg"></i>
          <span>Dashboard</span>
        </a>
        <a href="{{ route('pesananadmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200">
          <i class="fas fa-clipboard-list text-lg"></i>
          <span>Pesanan</span>
        </a>
        <a href="{{ route('daftarmobiladmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200">
          <i class="fas fa-car text-lg"></i>
          <span>Daftar Mobil</span>
        </a>
        <a href="{{ route('laporanadmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200">
          <i class="fas fa-file-alt text-lg"></i>
          <span>Laporan</span>
        </a>

        <!-- Logout -->
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 text-left">
            <i class="fas fa-sign-out-alt text-lg"></i>
            <span>Logout</span>
          </button>
        </form>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 flex flex-col bg-[#F7F7F7]">
      <!-- Header -->
      <header class="flex items-center justify-between border-b border-gray-200 px-8 py-4 bg-white">
        <form class="flex items-center bg-gray-100 rounded-full px-4 py-2 w-72 max-w-full" role="search">
          <input
            type="search"
            placeholder="Search"
            aria-label="Search"
            class="bg-transparent text-gray-700 placeholder-gray-400 text-sm focus:outline-none flex-grow"
          />
          <button type="submit" class="text-gray-500 ml-2">
            <i class="fas fa-search"></i>
          </button>
        </form>
        <div class="flex items-center space-x-4">
  <div class="hidden md:flex items-center space-x-4 ml-6">
    <span class="text-sm truncate max-w-xs select-text">{{ Auth::guard('admin')->user()->email }}</span>
    <i class="fas fa-user-circle text-2xl text-gray-500"></i>
  </div>
</div>
      </header>

      <!-- Main dashboard content here -->
      <section class="p-8 space-y-8">
        <!-- Income & Outcome cards -->
        <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0 max-w-5xl">
          <div class="bg-white rounded-xl p-6 flex-1 max-w-md">
            <p class="text-sm text-gray-600 mb-1 select-text">Income</p>
            <p class="text-2xl font-extrabold italic select-text">
              770.00K
              <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold rounded px-2 py-0.5 align-middle ml-2 select-text">+2.5%</span>
            </p>
            <p class="text-xs text-gray-400 mt-1 select-text">Compared to year (1000.000K)</p>
          </div>
          <div class="bg-white rounded-xl p-6 flex-1 max-w-md">
            <p class="text-sm text-gray-600 mb-1 select-text">Outcome</p>
            <p class="text-2xl font-extrabold italic select-text">
              25.000K
              <span class="inline-block bg-red-100 text-red-600 text-xs font-semibold rounded px-2 py-0.5 align-middle ml-2 select-text">-1.5%</span>
            </p>
            <p class="text-xs text-gray-400 mt-1 select-text">Compared to year (100.000K)</p>
          </div>
        </div>

        <!-- Status Mobil Table -->
        <div class="bg-white rounded-xl p-6 max-w-5xl">
         <div class="flex justify-between items-center mb-4">
        <h2 class="text-red-500 font-semibold italic select-text">Status Mobil</h2>
        <a href="{{ route('pesananadmin') }}" class="bg-red-500 text-white rounded-md px-5 py-2 text-sm select-none">Lihat Selengkapnya</a>
    </div>
          <table class="w-full text-sm text-left text-gray-700 border-separate border-spacing-y-3">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="py-2 font-normal w-12 select-text">No.</th>
                <th class="py-2 font-normal w-20 select-text">No.Mobil</th>
                <th class="py-2 font-normal select-text">Nama Client</th>
                <th class="py-2 font-normal w-28 select-text">Status</th>
                <th class="py-2 font-normal w-28 select-text">Harga Sewa</th>
           
              </tr>
            </thead>
            <tbody>
              @foreach ($pesans->take(3) as $index => $pesan)
                <tr class="border-b border-gray-100">
                  <td class="py-3 select-text">{{ sprintf('%02d', $index + 1) }}</td>
                  <td class="py-3 select-text">{{ $pesan->mobil->ID_Mobil }}</td>
                  <td class="py-3 flex items-center space-x-3 select-text">
                   
                    <span>{{ $pesan->nama_pelanggan }}</span>
                  </td>
                  <td class="py-3 select-text">
                    <span class="inline-block text-xs rounded-full px-3 py-1 font-semibold italic select-text
                      @if($pesan->status == 'on_going') bg-purple-200 text-purple-700
                      @elseif($pesan->status == 'finished') bg-green-100 text-green-600
                      @elseif($pesan->status == 'canceled') bg-red-100 text-red-600
                      @else bg-yellow-100 text-yellow-700 @endif">
                      {{ ucfirst(str_replace('_', ' ', $pesan->status)) }}
                    </span>
                  </td>
                  <td class="py-3 select-text">
                    RP {{ number_format($pesan->mobil->Harga_Sewa * (strtotime($pesan->tanggal_selesai) - strtotime($pesan->tanggal_mulai)) / (60 * 60 * 24), 0, ',', '.') }}
                  </td>
                  
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-xl p-6 max-w-5xl">
          <div class="mb-4 flex justify-between items-center">
            <h3 class="font-semibold italic select-text">Pemasukan</h3>
            <button class="border border-gray-300 rounded-md px-4 py-1 text-xs text-gray-700 flex items-center space-x-1 select-none">
              <span>This Week</span>
              <i class="fas fa-chevron-up text-xs"></i>
            </button>
          </div>
          <p class="text-blue-600 italic font-semibold text-xl mb-1 select-text">5.000,00</p>
          <p class="text-xs text-gray-400 mb-4 select-text">50 Orders</p>
        
          <div class="flex space-x-6 mt-4 text-xs select-text">
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 rounded-sm bg-blue-600"></div>
              <span>Income</span>
            </div>
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 rounded-sm bg-green-600"></div>
              <span>Outcome</span>
            </div>
            <div class="flex items-center space-x-1">
              <div class="w-3 h-3 rounded-sm bg-red-600"></div>
              <span>Cancel</span>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>