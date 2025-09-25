<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NNCARRENT - Laporan Penjualan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,600;1,600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex flex-col md:flex-row">
  <!-- Sidebar -->
  <aside class="hidden md:flex w-56 bg-white border-r border-gray-200 flex-col px-6 py-8 sticky top-0 h-screen">
    <h1 class="text-2xl font-extrabold italic text-red-500 select-none mb-20">
      NNCARRENT
    </h1>
    <nav class="flex flex-col space-y-8 text-gray-900 text-sm font-normal w-full">
      <a href=" {{ route('dashboardadmin') }}" class="hover:text-red-500 transition-colors duration-200 flex items-center">
        <i class="fas fa-th-large mr-2"></i> Dashboard
      </a>
      <a href="{{ route('pesananadmin') }}" class="hover:text-red-500 transition-colors duration-200 flex items-center">
        <i class="fas fa-clipboard-list mr-2"></i> Pesanan
      </a>
      <a href="{{ route('daftarmobiladmin') }}" class="hover:text-red-500 transition-colors duration-200 flex items-center">
        <i class="fas fa-car mr-2"></i> Daftar Mobil
      </a>
      <a href="#" aria-current="page" class="bg-red-500 text-white rounded-lg py-3 px-5 font-extrabold italic flex items-center">
        <i class="fas fa-file-alt mr-2"></i> Laporan
      </a>
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
  <main class="flex-1 p-6 md:p-8 overflow-auto max-w-full">
    <!-- Header -->
    <header class="flex flex-col md:flex-row items-center justify-between mb-8 space-y-4 md:space-y-0">
      <h2 class="font-semibold italic text-lg text-gray-900">
        Laporan Penjualan
      </h2>
      <div class="flex flex-col sm:flex-row items-center sm:space-x-6 w-full sm:w-auto space-y-4 sm:space-y-0">
        <div class="relative flex-1 sm:flex-none text-gray-400 focus-within:text-gray-600 transition-colors w-full sm:w-64">
          <input
            type="text"
            placeholder="Search"
            class="pl-4 pr-10 py-2 rounded-full border border-gray-300 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 w-full"
          />
          <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400"></i>
        </div>
        <div class="flex items-center justify-center w-8 h-8 rounded-full border border-gray-300 text-xs font-semibold text-gray-500 select-none">
          OK
        </div>
      <div class="flex items-center space-x-4">
  <div class="hidden md:flex items-center space-x-4 ml-6">
    <span class="text-sm truncate max-w-xs select-text">{{ Auth::guard('admin')->user()->email }}</span>
    <i class="fas fa-user-circle text-2xl text-gray-500"></i>
  </div>
</div>
      </div>
    </header>

    <!-- Filter and New Report -->
    

    <!-- Reports Table -->
    <section class="overflow-x-auto rounded-lg bg-white border border-gray-200 max-w-7xl">
  <table class="w-full text-left border-collapse min-w-[700px]">
    <thead>
      <tr class="bg-gray-50 border-b border-gray-200">
        <th class="py-3 px-6 font-semibold italic text-xs text-gray-700 border-r border-gray-200">ID</th>
        <th class="py-3 px-6 font-semibold italic text-xs text-gray-700 border-r border-gray-200">Tanggal Laporan</th>
        <th class="py-3 px-6 font-semibold italic text-xs text-gray-700 border-r border-gray-200">Jenis Laporan</th>
        <th class="py-3 px-6 font-semibold italic text-xs text-gray-700 border-r border-gray-200">Total (Rp)</th>
        <th class="py-3 px-6 font-semibold italic text-xs text-gray-700">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($laporans as $index => $laporan)
        <tr class="{{ $index % 2 == 0 ? 'border-b border-gray-100 hover:bg-gray-50 transition-colors' : 'bg-gray-50 border-b border-gray-100 hover:bg-gray-100 transition-colors' }}">
          <td class="py-4 px-6 text-sm text-gray-700">{{ $laporan->id }}</td>
          <td class="py-4 px-6 text-sm text-gray-700">{{ $laporan->tanggal_laporan->format('d/m/Y') }}</td>
          <td class="py-4 px-6 text-sm text-gray-700">{{ $laporan->jenis_laporan }}</td>
          <td class="py-4 px-6 text-sm text-gray-700">{{ number_format($laporan->total, 2, ',', '.') }}</td>
          <td class="py-4 px-6 flex items-center space-x-2">
            <a href="{{ route('laporan.show', $laporan->id) }}" class="bg-blue-600 text-white text-xs font-semibold italic rounded px-3 py-1 hover:bg-blue-700 transition-colors">
              Lihat
            </a>
            <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
              @csrf
              @method('DELETE')
              <button class="bg-red-100 text-red-600 text-xs font-semibold rounded px-2 py-1" type="submit" aria-label="Hapus laporan {{ $laporan->id }}">
                ×
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="py-4 px-6 text-sm text-gray-700 text-center">No reports available.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</section>
    <!-- Pagination -->
    <nav
      class="flex justify-center items-center space-x-2 mt-6 select-none text-sm text-gray-700"
      aria-label="Pagination"
    >
      <button
        class="border border-gray-300 rounded px-3 py-1 hover:bg-gray-100 transition-colors"
        aria-label="Previous page"
        type="button"
      >
        &lt;
      </button>
      <button
        class="bg-blue-600 text-white rounded px-3 py-1 font-semibold italic"
        aria-current="page"
        type="button"
      >
        1
      </button>
      <button
        class="border border-gray-300 rounded px-3 py-1 hover:bg-gray-100 transition-colors"
        type="button"
      >
        2
      </button>
      <button
        class="border border-gray-300 rounded px-3 py-1 hover:bg-gray-100 transition-colors"
        type="button"
      >
        3
      </button>
      <button
        class="border border-gray-300 rounded px-3 py-1 hover:bg-gray-100 transition-colors"
        aria-label="Next page"
        type="button"
      >
        &gt;
      </button>
    </nav>

   
  </main>
</body>
</html>