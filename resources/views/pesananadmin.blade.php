
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NNCARRENT - Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,600;1,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col md:flex-row">
    <aside class="w-full md:w-56 bg-white border-b md:border-b-0 md:border-r border-gray-200 flex flex-row md:flex-col px-6 py-4 md:py-8">
        <div class="flex items-center justify-between md:block mb-4 md:mb-12 w-full">
            <h1 class="text-2xl font-extrabold italic text-red-500 select-none">NNCARRENT</h1>
            <button class="md:hidden text-gray-600 focus:outline-none" id="sidebarToggle">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        <nav class="flex flex-row md:flex-col space-x-4 md:space-x-0 md:space-y-6 text-gray-900 text-sm font-normal w-full md:w-auto hidden md:flex" id="sidebarNav">
            <a href="{{ route('dashboardadmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap">
                <i class="fas fa-th-large text-lg"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pesananadmin') }}" class="flex items-center space-x-3 bg-red-500 text-white rounded-lg px-5 py-3 font-medium select-none whitespace-nowrap" aria-current="page">
                <i class="fas fa-clipboard-list text-lg"></i>
                <span>Pesanan</span>
            </a>
            <a href="{{ route('daftarmobiladmin') }}" class="flex items-center space-x-3 hover:text-red-500 transition-colors duration-200 whitespace-nowrap">
                <i class="fas fa-car text-lg"></i>
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
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700 border-separate border-spacing-y-3">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 pl-2 pr-4 font-normal w-12">No.</th>
                            <th class="text-left py-2 pr-4 font-normal w-24">No.Mobil</th>
                            <th class="text-left py-2 pr-4 font-normal">Nama Client</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Status</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Tanggal Mulai</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Tanggal Selesai</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Total Harga</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">KTP</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">SIM</th>
                            <th class="text-left py-2 pr-4 font-normal w-32">Bukti Pembayaran</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Antar Jemput</th>
                            <th class="text-left py-2 pr-4 font-normal w-32">Lokasi Antar</th>
                            <th class="text-left py-2 pr-4 font-normal w-32">Lokasi Jemput</th>
                            <th class="text-left py-2 pr-4 font-normal w-28">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($pesans) && $pesans->count() > 0)
                            @foreach ($pesans as $index => $pesan)
                                <tr class="bg-white border-b border-gray-100">
                                    <td class="py-3 pl-2 pr-4">{{ $index + 1 }}</td>
                                    <td class="py-3 pr-4">{{ $pesan->mobil ? $pesan->mobil->ID_Mobil : '-' }}</td>
                                    <td class="py-3 pr-4">{{ $pesan->nama_pelanggan }}</td>
                                    <td class="py-3 pr-4">
                                        <span class="inline-block text-xs rounded-full px-3 py-1 font-normal select-none
                                            {{ $pesan->status == 'on_going' ? 'bg-purple-200 text-purple-700 italic' : 
                                              ($pesan->status == 'finished' ? 'bg-green-100 text-green-600' : 
                                              ($pesan->status == 'canceled' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $pesan->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 pr-4">{{ \Carbon\Carbon::parse($pesan->tanggal_mulai)->format('d M Y') }}</td>
                                    <td class="py-3 pr-4">{{ \Carbon\Carbon::parse($pesan->tanggal_selesai)->format('d M Y') }}</td>
                                    <td class="py-3 pr-4">
                                        RP {{ number_format($pesan->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 pr-4">
                                        @if ($pesan->ktp_photo_path)
                                            <a href="{{ route('pesananadmin.download', ['file' => $pesan->ktp_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat KTP</a>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td class="py-3 pr-4">
                                        @if ($pesan->sim_photo_path)
                                            <a href="{{ route('pesananadmin.download', ['file' => $pesan->sim_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat SIM</a>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td class="py-3 pr-4">
                                        @if ($pesan->bukti_pembayaran_path)
                                            <a href="{{ route('pesananadmin.download', ['file' => $pesan->bukti_pembayaran_path]) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td class="py-3 pr-4">
                                        {{ $pesan->antar_jemput == 'antar-jemput' ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td class="py-3 pr-4">
                                        {{ $pesan->lokasi_antar ?? '-' }}
                                    </td>
                                    <td class="py-3 pr-4">
                                        {{ $pesan->lokasi_jemput ?? '-' }}
                                    </td>
                                    <td class="py-3 pr-4">
                                        <button data-modal-target="detail-modal-{{ $pesan->id }}" class="bg-red-500 text-white rounded-md px-4 py-1 text-sm select-none">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="14" class="py-3 text-center text-gray-500">Tidak ada data tersedia</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Modal untuk Detail Pesanan -->
        @foreach ($pesans as $pesan)
            <div id="detail-modal-{{ $pesan->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <section aria-label="Detail Pesanan #{{ $pesan->id }}" class="bg-[#FAFBFC] rounded-xl p-6 text-xs text-[#4B4B4B] space-y-6 w-full max-w-md mx-4 max-h-[80vh] overflow-y-auto shadow-[0_0_20px_rgba(0,0,0,0.05)]">
                    <header class="flex justify-between items-center border-b border-[#E6E6E6] pb-2">
                        <h3 class="font-semibold italic text-sm text-[#1E1E1E]">Detail Pesanan #{{ $pesan->id }}</h3>
                        <button data-modal-close="detail-modal-{{ $pesan->id }}" class="w-8 h-8 rounded-full bg-[#FFD7D9] text-[#FF6B6B] flex items-center justify-center font-bold text-lg leading-none focus:outline-none">
                            ×
                        </button>
                    </header>

                    <!-- Informasi Client -->
                    <section class="border-b border-[#E6E6E6] pb-6 space-y-4">
                        <h4 class="italic font-semibold text-xs text-[#1E1E1E]">Informasi Client</h4>
                        <div class="flex items-center space-x-6">
                            <div aria-label="Client initials" class="w-16 h-16 rounded-full bg-[#E6E6E6] flex items-center justify-center text-[#9E9E9E] font-semibold italic text-lg select-none">
                                {{ strtoupper(substr($pesan->nama_pelanggan, 0, 2)) }}
                            </div>
                            <div class="space-y-1 text-xs text-[#4B4B4B]">
                                <p class="font-semibold italic text-[#1E1E1E]">{{ $pesan->nama_pelanggan }}</p>
                                <p>{{ $pesan->nomor_hp }}</p>
                                <p>{{ $pesan->email }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Informasi Mobil & Informasi Sewa -->
                    <section class="flex flex-col border-b border-[#E6E6E6] pb-6 space-y-6">
                        <!-- Informasi Mobil -->
                        <div class="space-y-3">
                            <h4 class="italic font-semibold text-xs text-[#1E1E1E] mb-3">Informasi Mobil</h4>
                            <div class="flex items-center space-x-4">
                                <img alt="Placeholder image of a car" class="w-[120px] h-[100px] rounded-lg object-cover flex-shrink-0" src="{{ $pesan->mobil && $pesan->mobil->Foto ? asset('storage/' . $pesan->mobil->Foto) : 'https://via.placeholder.com/120x100' }}" height="100" width="120" />
                                <div class="text-xs text-[#4B4B4B] space-y-1">
                                    <p class="font-semibold italic text-[#1E1E1E]">{{ $pesan->mobil ? $pesan->mobil->Merek . ' ' . $pesan->mobil->Model : '-' }}</p>
                                    <p>No. Mobil: {{ $pesan->mobil ? $pesan->mobil->ID_Mobil : '-' }}</p>
                                    <p>Tahun: {{ $pesan->mobil ? $pesan->mobil->Tahun : '-' }}</p>
                                    @if($pesan->ktp_photo_path || $pesan->sim_photo_path || $pesan->bukti_pembayaran_path)
                                        <p>
                                            @if($pesan->ktp_photo_path)
                                                <a href="{{ route('pesananadmin.download', ['file' => $pesan->ktp_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">KTP</a>
                                            @endif
                                            @if($pesan->sim_photo_path)
                                                {{ $pesan->ktp_photo_path ? ' | ' : '' }}
                                                <a href="{{ route('pesananadmin.download', ['file' => $pesan->sim_photo_path]) }}" target="_blank" class="text-blue-600 hover:underline">SIM</a>
                                            @endif
                                            @if($pesan->bukti_pembayaran_path)
                                                {{ $pesan->ktp_photo_path || $pesan->sim_photo_path ? ' | ' : '' }}
                                                <a href="{{ route('pesananadmin.download', ['file' => $pesan->bukti_pembayaran_path]) }}" target="_blank" class="text-blue-600 hover:underline">Bukti</a>
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Sewa -->
                        <div class="space-y-3">
                            <h4 class="italic font-semibold text-xs text-[#1E1E1E] mb-3">Informasi Sewa</h4>
                            <div class="flex items-center space-x-3 mb-3">
                                <div aria-label="Calendar icon" class="w-6 h-6 rounded-full bg-[#D7E6F7] flex items-center justify-center text-xs text-[#4B6CB7] font-semibold select-none">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="text-xs text-[#4B4B4B]">
                                    <p class="font-semibold italic text-[#1E1E1E]">Periode Sewa</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($pesan->tanggal_mulai)->format('d M Y') }} - 
                                        {{ \Carbon\Carbon::parse($pesan->tanggal_selesai)->format('d M Y') }} 
                                        ({{ (strtotime($pesan->tanggal_selesai) - strtotime($pesan->tanggal_mulai)) / (60 * 60 * 24) }} Hari)
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div aria-label="Dollar sign icon" class="w-6 h-6 rounded-full bg-[#D7E6D7] flex items-center justify-center text-xs text-[#4B7B4B] font-semibold select-none">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="text-xs text-[#4B4B4B]">
                                    <p class="font-semibold italic text-[#1E1E1E]">Pembayaran</p>
                                    @if($pesan->mobil)
                                        <p>Harga Sewa: RP {{ number_format($pesan->mobil->Harga_Sewa * (strtotime($pesan->tanggal_selesai) - strtotime($pesan->tanggal_mulai)) / (60 * 60 * 24), 0, ',', '.') }}</p>
                                        @if($pesan->antar_jemput == 'antar-jemput')
                                            <p>Biaya Antar Jemput: RP {{ number_format(50000, 0, ',', '.') }}</p>
                                        @endif
                                        <p class="font-bold text-sm text-[#1E1E1E]">Total: RP {{ number_format($pesan->total_harga, 0, ',', '.') }}</p>
                                    @else
                                        <p>-</p>
                                    @endif
                                    <p class="text-xs text-[#7B7B7B]">
                                        Status: {{ $pesan->bukti_pembayaran_path ? 'Sudah dibayar' : 'Belum dibayar' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Catatan -->
                    @if($pesan->antar_jemput == 'antar-jemput' || $pesan->rejection_reason)
                        <section>
                            <h4 class="italic font-semibold text-xs text-[#1E1E1E] mb-2">Catatan</h4>
                            <textarea aria-label="Catatan" class="w-full rounded-lg bg-[#F5F7F8] border border-[#E6E6E6] p-3 text-xs text-[#9E9E9E] resize-none h-16" readonly>
                                @if($pesan->antar_jemput == 'antar-jemput')
                                    Antar Jemput: Ya
                                    Lokasi Antar: {{ $pesan->lokasi_antar ?? '-' }}
                                    Lokasi Jemput: {{ $pesan->lokasi_jemput ?? '-' }}
                                @endif
                                @if($pesan->rejection_reason)
                                    {{ $pesan->antar_jemput == 'antar-jemput' ? "\n" : '' }}
                                    Alasan Penolakan: {{ $pesan->rejection_reason }}
                                @endif
                            </textarea>
                        </section>
                    @endif

                    <!-- Status Verifikasi -->
                    <section>
                        <h4 class="italic font-semibold text-xs text-[#1E1E1E] mb-2">Status Verifikasi</h4>
                        @if ($pesan->verification_status == 'pending')
                            <form action="{{ route('pesananadmin.verify', $pesan->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="flex gap-3">
                                    <button type="submit" name="status" value="approved" class="bg-[#4CAF50] text-white rounded-lg px-6 py-2 italic font-semibold hover:bg-[#3B8B3B] transition">Terima</button>
                                    <button type="submit" name="status" value="rejected" class="bg-[#FF3B2F] text-white rounded-lg px-6 py-2 italic font-semibold hover:bg-[#D62E26] transition">Tolak</button>
                                </div>
                                <input type="text" name="rejection_reason" placeholder="Alasan penolakan (opsional)" class="w-full rounded-lg bg-[#F5F7F8] border border-[#E6E6E6] p-3 text-xs text-[#4B4B4B]"/>
                            </form>
                        @else
                            <span class="inline-block text-xs rounded-full px-3 py-1 font-normal select-none
                                {{ $pesan->verification_status == 'approved' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ ucfirst($pesan->verification_status) }}
                            </span>
                        @endif
                    </section>

                    <!-- Buttons -->
                    <section class="flex justify-between gap-3 mt-6 text-xs font-semibold">
                        <button data-modal-close="detail-modal-{{ $pesan->id }}" class="bg-[#2196F3] text-white rounded-lg px-6 py-2 italic font-semibold hover:bg-[#1B7ED6] transition">Kembali</button>
                    </section>
                </section>
            </div>
        @endforeach
    </main>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarNav = document.getElementById('sidebarNav');

        // Toggle sidebar untuk mobile
        sidebarToggle.addEventListener('click', () => {
            sidebarNav.classList.toggle('hidden');
            sidebarNav.classList.toggle('flex');
        });

        // Atur visibilitas sidebar berdasarkan ukuran layar
        function updateSidebarVisibility() {
            if (window.innerWidth >= 768) {
                sidebarNav.classList.remove('hidden');
                sidebarNav.classList.add('flex');
            } else {
                sidebarNav.classList.add('hidden');
                sidebarNav.classList.remove('flex');
            }
        }
        updateSidebarVisibility();
        window.addEventListener('resize', updateSidebarVisibility);

        // Mengelola modal dengan event delegation
        document.addEventListener('click', (e) => {
            const target = e.target.closest('[data-modal-target]');
            if (target) {
                const modalId = target.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) modal.classList.remove('hidden');
            }

            const closeTarget = e.target.closest('[data-modal-close]');
            if (closeTarget) {
                const modalId = closeTarget.getAttribute('data-modal-close');
                const modal = document.getElementById(modalId);
                if (modal) modal.classList.add('hidden');
            }

            // Tutup modal saat klik di luar
            if (e.target.classList.contains('fixed')) {
                const modal = e.target.querySelector('[id^="detail-modal-"]');
                if (modal && !modal.contains(e.target)) {
                    modal.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>
```