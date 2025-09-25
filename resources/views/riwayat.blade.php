<!DOCTYPE html>
<html lang="en" x-data="{ activeTab: 'riwayat' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyewaan - NNCARRENT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: black;
            border-right: 2px solid #0a0a0aff;
            padding: 20px;
            position: relative;
        }

        .brand {
            color: #f62f32;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 2px solid #f62f32;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin: 15px 0;
        }

        .nav-link {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 16px;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: #f62f32;
            background-color: #fee2e2;
            transform: translateX(5px);
        }

        .nav-link.active {
            color: #f62f32 !important;
            background-color: #fee2e2;
            font-weight: 600;
        }

        .menu-icon {
            width: 20px;
            color: #f62f32;
        }

        .logo {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 180px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            background-color: white;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .welcome {
            color: #f62f32;
            font-size: 28px;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 8px 20px;
            border-radius: 30px;
            transition: 0.3s;
            cursor: pointer;
            background-color: #f8f9fa;
            border: 2px solid #eee;
        }

        .profile-container:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
        }

        .profile-icon {
            font-size: 28px;
            color: #f62f32;
        }

        .user-name {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .user-email {
            color: #666;
            font-size: 13px;
            font-style: italic;
        }

        /* Card */
        .card {
            border: 2px solid #eee;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .car-info-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .car-image {
            width: 200px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #eee;
        }

        .car-title {
            color: #000000;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .car-details p {
            margin: 8px 0;
            color: #555;
        }

        .price-action-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
        }

        .price {
            font-weight: bold;
            color: #333;
            font-size: 18px;
            margin: 0;
        }

        .btn {
            background-color: #f62f32;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #d62528;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">NNCARRENT</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'dashboard' }"
                       @click="activeTab = 'dashboard'">
                        <i class="fas fa-home menu-icon"></i>
                        Kembali Ke Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('riwayat') }}" 
                       class="nav-link active"
                       :class="{ 'active': activeTab === 'riwayat' }"
                       @click="activeTab = 'riwayat'">
                        <i class="fas fa-history menu-icon"></i>
                        Riwayat Penyewaan
                    </a>
                </li>
             
            </ul>
  
        </div>

        <!-- Main Content -->
        <div class="main-content">
    <div class="header">
        <h1 class="welcome">RIWAYAT PENYEWAAN</h1>
        <div class="profile-container"></div>
    </div>

    @if($pesanan->isEmpty())
        <p>Tidak ada riwayat penyewaan.</p>
    @else
        @foreach($pesanan as $p)
            <div class="card">
                <div class="car-info-container">
                    {{-- kalau ada relasi ke mobil --}}
                    @if($p->mobil && $p->mobil->Foto)
                    <img src="{{ asset($p->mobil->Foto) }}" alt="Mobil" class="car-image">
                    
                    @endif
                    <div>
                        <h2 class="car-title">
                            {{ $p->mobil ? $p->mobil->Merek.' '.$p->mobil->Model : 'Mobil tidak ditemukan' }}
                        </h2>
                        <div class="car-details">
                            <p><strong>Tanggal Sewa:</strong> {{ $p->tanggal_mulai }}</p>
                            <p><strong>Tanggal Kembali:</strong> {{ $p->tanggal_selesai }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($p->status) }}</p>
                        </div>
                    </div>
                </div>
                <div class="price-action-container">
<p class="price">
  Rp {{ number_format(
      $p->mobil->Harga_Sewa *
      (strtotime($p->tanggal_selesai) - strtotime($p->tanggal_mulai)) / (60 * 60 * 24),
      0, ',', '.'
  ) }}
</p>

                    <!-- Tombol Reschedule (hanya tampil jika status pending atau on_going) -->
                    @if($p->status === 'pending' || $p->status === 'on_going')
                        <a href="{{ route('pesanan.reschedule', $p->id) }}" class="btn">Reschedule</a>
                    @else
                        <span style="color: #666; font-style: italic;">Tidak dapat di-reschedule</span>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>


                </div>
            </div>
        </div>
    </div>
    
</body>
</html>