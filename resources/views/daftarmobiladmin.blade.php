<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>NNCARRENT - Daftar Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="w-full md:w-56 bg-white border-b md:border-b-0 md:border-r border-gray-200 flex flex-row md:flex-col px-6 py-4 md:py-8">
        <div class="flex items-center justify-between md:block mb-4 md:mb-12 w-full">
            <h1 class="text-2xl font-extrabold italic text-red-500 select-none">NNCARRENT</h1>
            <button class="md:hidden text-gray-600 focus:outline-none" id="sidebarToggle">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        <nav class="flex flex-row md:flex-col space-x-4 md:space-x-0 md:space-y-6 text-gray-900 text-sm font-normal w-full md:w-auto" id="sidebarNav">
            <a class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap" href="{{ route('dashboardadmin') }}">
                <i class="fas fa-th-large text-lg"></i>
                <span>Dashboard</span>
            </a>
            <a class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap" href="{{ route('pesananadmin') }}">
                <i class="fas fa-clipboard-list text-lg"></i>
                <span>Pesanan</span>
            </a>
            <a aria-current="page" class="flex items-center space-x-3 bg-red-500 text-white rounded-lg px-5 py-3 font-medium whitespace-nowrap" href="{{ route('mobil.index') }}">
                <i class="fas fa-car text-lg"></i>
                <span>Daftar Mobil</span>
            </a>
            <a class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap" href="{{ route('laporanadmin') }}">
                <i class="fas fa-file-alt text-lg"></i>
                <span>Laporan</span>
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

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-auto p-8">
        <!-- Header -->
        <header class="flex items-center justify-between border-b border-gray-200 px-0 md:px-8 py-4 mb-8">
            <form class="flex items-center bg-gray-100 rounded-full px-4 py-2 w-full max-w-md" role="search" method="GET" action="{{ route('mobil.index') }}">
                <input aria-label="Search" name="search" class="bg-transparent text-gray-700 placeholder-gray-400 text-sm focus:outline-none flex-grow" placeholder="Cari mobil..." type="search" value="{{ request('search') }}"/>
                <button class="text-gray-500 ml-2" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-4 ml-6">
                    @if (Auth::guard('admin')->check())
                        <span class="text-sm truncate max-w-xs select-text">{{ Auth::guard('admin')->user()->email }}</span>
                        <i class="fas fa-user-circle text-2xl text-gray-500"></i>
                    @else
                        <span class="text-sm truncate max-w-xs select-text">Guest</span>
                        <i class="fas fa-user-circle text-2xl text-gray-500"></i>
                    @endif
                </div>
            </div>
        </header>

        <!-- Action Button -->
        <div class="flex justify-end mb-6">
            <a href="{{ route('mobil.create') }}" class="bg-green-600 text-white font-medium rounded-md py-2 px-4 flex items-center space-x-2 hover:bg-green-700 transition-colors duration-200 whitespace-nowrap">
                <span>Tambah Mobil</span>
            </a>
        </div>

        <!-- Tabel Mobil -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-sm">
                <thead class="bg-gray-200 text-gray-700 text-sm uppercase text-left">
                    <tr>
                        <th class="py-3 px-4">Merek</th>
                        <th class="py-3 px-4">Model</th>
                        <th class="py-3 px-4">Tahun</th>
                        <th class="py-3 px-4">Harga Sewa</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Jumlah Kursi</th>
                        <th class="py-3 px-4">Jenis Transmisi</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse ($mobils as $mobil)
                    <tr class="{{ $mobil->trashed() ? 'bg-red-100' : 'bg-white' }}">
                        <td class="py-2 px-4">{{ $mobil->Merek }}</td>
                        <td class="py-2 px-4">{{ $mobil->Model }}</td>
                        <td class="py-2 px-4">{{ $mobil->Tahun }}</td>
                        <td class="py-2 px-4">Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</td>
                        <td class="py-2 px-4">
                            {{ $mobil->Status_Ketersediaan ? 'Tersedia' : ($mobil->trashed() ? 'Maintenance' : 'Tidak Tersedia') }}
                        </td>
                        <td class="py-2 px-4">{{ $mobil->Jumlah_Kursi }}</td>
                        <td class="py-2 px-4">{{ ucfirst($mobil->Jenis_Transmisi) }}</td>
                        <td class="py-2 px-4 space-x-1">
                            @if(!$mobil->trashed())
                                <a href="{{ route('mobil.edit', $mobil->ID_Mobil) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs">Edit</a>
                                <form action="{{ route('mobil.destroy', $mobil->ID_Mobil) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            @else
                                <form action="{{ route('mobil.restore', $mobil->ID_Mobil) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Restore</button>
                                </form>
                                <form action="{{ route('mobil.forceDelete', $mobil->ID_Mobil) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-black text-xs" onclick="return confirm('Yakin hapus permanen?')">Force Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Data belum tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarNav = document.getElementById('sidebarNav');
        sidebarToggle.addEventListener('click', () => sidebarNav.classList.toggle('hidden'));
        if (window.innerWidth < 768) sidebarNav.classList.add('hidden');
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) sidebarNav.classList.remove('hidden');
            else sidebarNav.classList.add('hidden');
        });
    </script>
</body>
</html>