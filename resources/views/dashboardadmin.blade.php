<!DOCTYPE html>
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
        <h1 class="text-2xl font-extrabold italic text-red-500">NNCARRENT</h1>
      </div>
      <nav class="flex flex-col space-y-6 text-gray-900 text-sm font-normal">
        <a href="#" class="flex items-center space-x-3 bg-red-500 text-white rounded-lg px-5 py-3 font-medium">
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
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 text-left">
            <i class="fas fa-sign-out-alt text-lg"></i>
            <span>Logout</span>
          </button>
        </form>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="flex items-center justify-between border-b border-gray-200 px-8 py-4">
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
            <!-- Displaying the logged-in user email -->
            @if (Auth::guard('admin')->check())
              <span class="text-sm truncate max-w-xs">{{ Auth::guard('admin')->user()->email }}</span>
            @elseif (Auth::guard('pelanggan')->check())
              <span class="text-sm truncate max-w-xs">{{ Auth::guard('pelanggan')->user()->email }}</span>
            @endif
            <i class="fas fa-user-circle text-2xl text-gray-500"></i>
          </div>
        </div>
      </header>

      <!-- Main dashboard content here -->
      <section class="p-8">
        <h2 class="text-xl font-semibold mb-4">Selamat datang di dashboard</h2>
        <!-- Tambahkan konten lainnya di sini -->
      </section>
    </main>
  </div>
</body>
</html>
