<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NNCARRENT Pesanan Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-white text-gray-900 min-h-screen flex flex-col md:flex-row">
  <aside class="w-full md:w-56 bg-white border-b md:border-b-0 md:border-r border-gray-200 flex flex-row md:flex-col px-6 py-4 md:py-8">
    <div class="flex items-center justify-between md:block mb-4 md:mb-12 w-full">
      <h1 class="text-2xl font-extrabold italic text-red-500 select-none">NNCARRENT</h1>
      <button class="md:hidden text-gray-600 focus:outline-none" id="sidebarToggle">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
    <nav class="flex flex-row md:flex-col space-x-4 md:space-x-0 md:space-y-6 text-gray-900 text-sm font-normal w-full md:w-auto" id="sidebarNav">
      <a href="{{ route('dashboardadmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap">
        <i class="fas fa-th-large text-lg"></i>
        <span>Dashboard</span>
      </a>
      <a href="{{ route('pesananadmin.index') }}" class="flex items-center space-x-3 bg-red-500 text-white rounded-lg px-5 py-3 font-medium whitespace-nowrap" aria-current="page">
        <i class="fas fa-clipboard-list text-lg"></i>
        <span>Pesanan</span>
      </a>
      <a href="{{ route('daftarmobiladmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap">
        <i class="fas fa-shopping-cart text-lg"></i>
        <span>Daftar Mobil</span>
      </a>
      <a href="{{ route('laporanadmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap">
        <i class="fas fa-file-alt text-lg"></i>
        <span>Laporan</span>
      </a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 text-left">
          <i class="fas fa-sign-out-alt text-lg"></i>
          <span>Logout</span>
        </button>
      </form>
    </nav>
  </aside>

  <main class="flex-1 flex flex-col overflow-auto p-8">
    <h2 class="text-red-500 font-extrabold italic text-lg mb-6">Pesanan Admin</h2>

    @if (session('success'))
      <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <section class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 overflow-x-auto max-w-7xl">
      <table class="w-full text-sm text-gray-700 border-separate border-spacing-y-3 min-w-[1200px]">
        <thead>
          <tr class="border-b border-gray-200">
            <th class="text-left py-2 pl-2 pr-6 font-normal w-12">No.</th>
            <th class="text-left py-2 pr-6 font-normal w-24">No.Mobil</th>
            <th class="text-left py-2 pr-6 font-normal">Nama Client</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Status</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Tanggal Mulai</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Tanggal Selesai</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Harga Sewa</th>
            <th class="text-left py-2 pr-6 font-normal w-28">KTP</th>
            <th class="text-left py-2 pr-6 font-normal w-28">SIM</th>
            <th class="text-left py-2 pr-6 font-normal w-32">Bukti Pembayaran</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Antar Jemput</th>
            <th class="text-left py-2 pr-6 font-normal w-32">Lokasi Antar</th>
            <th class="text-left py-2 pr-6 font-normal w-32">Lokasi Jemput</th>
            <th class="text-left py-2 pr-6 font-normal w-28">Verifikasi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pesans as $index => $pesan)
            <tr class="bg-white border-b border-gray-100">
              <td class="py-3 pl-2 pr-6">{{ $index + 1 }}</td>
              <td class="py-3 pr-6">{{ $pesan->mobil->ID_Mobil }}</td>
              <td class="py-3 pr-6">{{ $pesan->nama_pelanggan }}</td>
              <td class="py-3 pr-6">
                <span class="inline-block text-xs rounded-full px-3 py-1 font-normal select-none
                  {{ $pesan->status == 'on_going' ? 'bg-purple-200 text-purple-700 italic' : 
                    ($pesan->status == 'finished' ? 'bg-green-100 text-green-600' : 
                    ($pesan->status == 'canceled' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700')) }}">
                  {{ ucfirst(str_replace('_', ' ', $pesan->status)) }}
                </span>
              </td>
              <td class="py-3 pr-6">{{ $pesan->tanggal_mulai }}</td>
              <td class="py-3 pr-6">{{ $pesan->tanggal_selesai }}</td>
              <td class="py-3 pr-6">
                RP {{ number_format($pesan->mobil->Harga_Sewa * (strtotime($pesan->tanggal_selesai) - strtotime($pesan->tanggal_mulai)) / (60 * 60 * 24), 0, ',', '.') }}
              </td>
              <td class="py-3 pr-6">
                @if ($pesan->ktp_photo_path)
                  <a href="{{ route('pesananadmin.download', ['file' => $pesan->ktp_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat KTP</a>
                @else
                  Tidak ada
                @endif
              </td>
              <td class="py-3 pr-6">
                @if ($pesan->sim_photo_path)
                  <a href="{{ route('pesananadmin.download', ['file' => $pesan->sim_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat SIM</a>
                @else
                  Tidak ada
                @endif
              </td>
              <td class="py-3 pr-6">
                @if ($pesan->bukti_pembayaran_path)
                  <a href="{{ route('pesananadmin.download', ['file' => $pesan->bukti_pembayaran_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                @else
                  Tidak ada
                @endif
              </td>
              <td class="py-3 pr-6">
                {{ $pesan->antar_jemput == 'antar-jemput' ? 'Ya' : 'Tidak' }}
              </td>
              <td class="py-3 pr-6">
                {{ $pesan->lokasi_antar ?? '-' }}
              </td>
              <td class="py-3 pr-6">
                {{ $pesan->lokasi_jemput ?? '-' }}
              </td>
              <td class="py-3 pr-6">
                @if ($pesan->verification_status == 'pending')
                  <form action="{{ route('pesananadmin.verify', $pesan->id) }}" method="POST">
                    @csrf
                    <select name="status" class="border rounded-md p-1 text-xs">
                      <option value="approved">Setujui</option>
                      <option value="rejected">Tolak</option>
                    </select>
                    <input type="text" name="rejection_reason" placeholder="Alasan penolakan" class="border rounded-md p-1 mt-2 text-xs w-24" />
                    <button type="submit" class="bg-red-500 text-white text-xs rounded-md px-3 py-1 mt-2">Simpan</button>
                  </form>
                @else
                  <span class="inline-block text-xs rounded-full px-3 py-1 font-normal select-none {{ $pesan->verification_status == 'approved' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    {{ ucfirst($pesan->verification_status) }}
                  </span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </main>

  <script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarNav = document.getElementById('sidebarNav');

    sidebarToggle.addEventListener('click', () => {
      sidebarNav.classList.toggle('hidden');
    });

    if(window.innerWidth < 768) {
      sidebarNav.classList.add('hidden');
    }

    window.addEventListener('resize', () => {
      if(window.innerWidth >= 768) {
        sidebarNav.classList.remove('hidden');
      } else {
        sidebarNav.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
