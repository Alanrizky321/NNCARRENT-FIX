<!DOCTYPE html>
<html lang="en" x-data="{ activeTab: 'notifikasi' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - NNCARRENT</title>
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
            background-color: white;
            border-right: 2px solid #e5e7eb;
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

        .notification-card {
            border: 2px solid #eee;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .notification-title {
            color: #f62f32;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .notification-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .notification-date {
            color: #666;
            font-size: 14px;
            text-align: right;
        }

        .divider {
            border-bottom: 2px solid #eee;
            margin: 20px 0;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 8px 20px;
            border-radius: 30px;
            background-color: #f8f9fa;
            border: 2px solid #eee;
        }

        .profile-icon {
            font-size: 28px;
            color: #f62f32;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Persis Dashboard -->
        <div class="sidebar">
            <div class="brand">NNCARRENT</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'dashboard' }"
                       @click="activeTab = 'dashboard'">
                        <i class="fas fa-home menu-icon"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('riwayat') }}" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'riwayat' }"
                       @click="activeTab = 'riwayat'">
                        <i class="fas fa-history menu-icon"></i>
                        Riwayat Penyewaan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ulasan') }}" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'ulasan' }"
                       @click="activeTab = 'ulasan'">
                        <i class="fas fa-star menu-icon"></i>
                        Ulasan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notifikasi') }}" 
                       class="nav-link active"
                       :class="{ 'active': activeTab === 'notifikasi' }"
                       @click="activeTab = 'notifikasi'">
                        <i class="fas fa-bell menu-icon"></i>
                        Notifikasi
                    </a>
                </li>
                
                <!-- Kategori Baru -->
                <li class="nav-item">
                    <a href="{{ route('kategori') }}" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'kategori' }"
                       @click="activeTab = 'kategori'">
                        <i class="fas fa-th-large menu-icon"></i>
                        Kategori
                    </a>
                </li>
            </ul>
            <img src="web.jpg" alt="Logo" class="logo">
        </div>

        <!-- Konten Notifikasi -->
        <div class="main-content">
            <div class="header">
                <h1 class="welcome">NOTIFIKASI</h1>
                <div class="profile-container">
                    <i class="fas fa-user-circle profile-icon"></i>
                    <div class="profile-info">
                        <div class="user-email">HajiAlan@nncarrent.com</div>
                    </div>
                </div>
            </div>

            <!-- Daftar Notifikasi -->
            <div class="notification-card">
                <h3 class="notification-title">Persetujuan Diterima</h3>
                <p class="notification-content">
                    Terima kasih, HajiAlan@gmail.com! Mobil Toyota Alphard telah dipesan untuk tanggal 
                    <span style="color: #f62f32;">[05/05/2025-06/05/2025]</span>.
                </p>
                <p class="notification-date">05 Mei 2025</p>
            </div>

            <div class="divider"></div>

            <div class="notification-card">
                <h3 class="notification-title">Pengingat Pengembalian</h3>
                <p class="notification-content">
                    Mobil Toyota Alphard harus dikembalikan sebelum pukul 17.00 hari ini. 
                    Keterlambatan dikenakan biaya tambahan.
                </p>
                <p class="notification-date">06 Mei 2025</p>
            </div>
        </div>
    </div>
</body>
</html>
