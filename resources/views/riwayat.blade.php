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
                        Dashboard
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
                    <a href="#" 
                       class="nav-link"
                       :class="{ 'active': activeTab === 'notifikasi' }"
                       @click="activeTab = 'notifikasi'">
                        <i class="fas fa-bell menu-icon"></i>
                        Notifikasi
                    </a>
                </li>

                <!-- Kategori Sidebar -->
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 class="welcome">RIWAYAT PENYEWAAN</h1>
                <div class="profile-container">
                    <i class="fas fa-user-circle profile-icon"></i>
                    <div class="profile-info">
                        <div class="user-email">HajiAlan@nncarrent.com</div>
                    </div>
                </div>
            </div>

            <!-- Rental History Cards -->
            <div class="card">
                <div class="car-info-container">
                    <img src="alphard.jpg" alt="Toyota Alphard" class="car-image">
                    <div class="car-details">
                        <h2 class="car-title">Toyota Alphard</h2>
                        <p>MPV</p>
                        <p>Tanggal Penyewaan: 1/06/2025 - 12/05/2025</p>
                    </div>
                </div>
                <div class="price-action-container">
                    <p class="price">Rp 1.000.000.00 / hari</p>
                    <button class="btn">Detail</button>
                </div>
            </div>

            <div class="card">
                <div class="car-info-container">
                    <img src="avanza.jpg" alt="Toyota Avanza" class="car-image">
                    <div class="car-details">
                        <h2 class="car-title">Toyota Avanza</h2>
                        <p>MPV</p>
                        <p>Tanggal Penyewaan: 15/06/2025 - 20/06/2025</p>
                    </div>
                </div>
                <div class="price-action-container">
                    <p class="price">Rp 500.000.00 / hari</p>
                    <button class="btn">Detail</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
