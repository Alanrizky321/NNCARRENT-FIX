<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NNCARRENT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .register-form {
            padding: 40px;
            width: 50%;
        }
        .register-form h2 {
            font-weight: bold;
            color: #333;
            text-align: center;
        }
        .register-form p {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }
        .register-form .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .register-form .btn-register {
            width: 100%;
            padding: 10px;
            background-color: #f62f32;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }
        .register-form .btn-register:hover {
            background-color: #b30000;
        }
        .register-image {
            background-color: #f8f9fa;
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }
        .register-image h3 {
            font-weight: bold;
            color: #333;
        }
        .register-image img {
            width: 60%;
            margin-top: 20px;
        }
        .brand-text {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #f62f32;
        }
        .text-danger {
            color: #f62f32;
        }
        .nncarrent-text {
    position: fixed;
    top: 10px;
    left: 20px;
    font-size: 24px;
    font-weight: bold;
    font-family: "PT Sans", sans-serif;
    color: #f62f32;
    z-index: 1000;
}

.nncarrent-text:hover {
    color: #b30000;
}
    </style>
</head>
<body>
   <!-- Teks NNCARRENT di pojok kiri atas -->
   <div class="nncarrent-text">
    <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">NNCARRENT</a>
    </div>
    <!-- Container Register -->
    <div class="container">
        <div class="register-box">
            <!-- Form Register -->
            <div class="register-form">
                <h2>Daftar Akun Baru</h2>
                <p>Silahkan isi data diri kamu</p>

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Registrasi -->
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="**********" required>
                    </div>

                    <!-- Tombol Daftar -->
                    <button type="submit" class="btn btn-register">Daftar Sekarang</button>
                </form>

                <!-- Link Login -->
                <div class="text-center mt-3">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" style="color: #f62f32;">Masuk disini</a></p>
                </div>
            </div>

            <!-- Gambar dan Pesan Selamat Datang -->
            <div class="register-image">
                <h3>Bergabunglah Bersama <span style="color: #f62f32;">NNCARRENT</span></h3>
                <img src="web.jpg" alt="Register Illustration">
            </div>
        </div>
    </div>
</body>
</html>