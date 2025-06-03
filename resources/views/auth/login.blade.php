<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NNCARRENT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- PT Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- FontAwesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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

        body {
            background-color: #f8f9fa;
            font-family: 'PT Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-login {
            display: flex;
            align-items: center;
            gap: 30px;
            max-width: 1000px;
            width: 100%;
            padding: 20px;
        }

        .login-form {
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }

        .login-form h2 {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .login-form p {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .login-form .form-group label {
            font-weight: bold;
            color: #555;
        }

        .login-form .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            padding: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .login-form .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #f62f32;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form .btn-login:hover {
            background-color: #b30000;
        }

        .login-form .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .login-form a {
            color: #f62f32;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        .login-logo {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 439px;
            height: 591px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .welcome-text {
            font-family: Arial, sans-serif;
            color: #333;
            margin-bottom: 40px;
            font-size: 20px;
            line-height: 1.5;
        }

        .welcome-text span {
            font-family: 'PT Sans', sans-serif;
            font-weight: bold;
            color: #f62f32;
            font-size: 28px;
            display: block;
            margin-top: 10px;
        }

        .login-logo img {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container-login {
                flex-direction: column;
                gap: 30px;
                padding: 15px;
            }

            .login-logo {
                width: 100%;
                height: auto;
                padding: 30px;
                max-width: 439px;
            }

            .login-form {
                padding: 15px;
                max-width: 100%;
            }

            .welcome-text {
                font-size: 18px;
                margin-bottom: 30px;
            }

            .welcome-text span {
                font-size: 24px;
            }

            .login-logo img {
                max-height: 300px;
            }

            .nncarrent-text {
                font-size: 20px;
                left: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="nncarrent-text">
        <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">NNCARRENT</a>
    </div>

    <div class="container-login">
        <!-- Form Login -->
        <div class="login-form">
            <h2>Log In</h2>
            <p>Silahkan Masukkan Informasi Akun kamu</p>

            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Menampilkan pesan kesalahan jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email kamu" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePassword">
                                <i class="fa fa-eye" id="eye-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat Saya</label>
                    </div>
                    <a href="{{ route('password.request') }}">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-login">Masuk</button>

                <div class="footer">
                    Belum memiliki akun? <a href="{{ route('register') }}">Daftar</a>
                </div>
            </form>
        </div>

        <!-- Logo dan Welcome Text -->
        <div class="login-logo">
            <div class="welcome-text">
                Halo, Selamat datang kembali di
                <span>NNCARRENT</span>
            </div>
            <img src="web.jpg" alt="NN Family Trans Wisata">
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>