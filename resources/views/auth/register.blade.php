<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NNCARRENT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- PT Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
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

        .container-register {
            display: flex;
            align-items: center;
            gap: 130px;
            max-width: 1000px;
            width: 100%;
            padding: 20px;
        }

        .register-form {
            padding: 20px;
            width: 100%;
            max-width: 400px;
            background: transparent;
            box-shadow: none;
        }

        .register-form h2 {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .register-form p {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .register-form .form-group label {
            font-weight: bold;
            color: #555;
        }

        .register-form .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            padding: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-register {
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

        .btn-register:hover {
            background-color: #b30000;
        }

        .text-center.mt-3 {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .text-center.mt-3 a {
            color: #f62f32;
            text-decoration: none;
        }

        .text-center.mt-3 a:hover {
            text-decoration: underline;
        }

        .register-image {
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

        .register-image img {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .container-register {
                flex-direction: column;
                gap: 30px;
                padding: 15px;
            }

            .register-image {
                width: 100%;
                height: auto;
                padding: 30px;
                max-width: 439px;
            }

            .register-form {
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

            .register-image img {
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
        <a href="{{ route(name: 'home') }}" style="text-decoration: none; color: inherit;">NNCARRENT</a>
    </div>

    <div class="container-register">
        <div class="register-form">
            <h2>Daftar Akun Baru</h2>
            <p>Silahkan isi data diri kamu</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<form id="registerForm" action="{{ route('register.submit') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email kamu" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="no_hp">No Hp</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP kamu" value="{{ old('no_hp') }}" required>
        @error('no_hp')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>
<button type="submit" class="btn btn-register">Daftar Sekarang</button>
</form>

<script>
    function validateAndSubmit() {
        const email = document.getElementById('email').value.trim();
        const noHp = document.getElementById('no_hp').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirmation').value;

        if (!email || !noHp || !password || !passwordConfirm) {
            alert('Harap isi semua field sebelum mendaftar.');
            return;
        }

        if (password !== passwordConfirm) {
            alert('Password dan konfirmasi password tidak sama.');
            return;
        }

        document.getElementById('registerForm').submit();
    }
</script>


            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
            </div>
        </div>

        <div class="register-image">
            <div class="welcome-text">
                Bergabunglah bersama
                <span>NNCARRENT</span>
            </div>
   <img src="{{ asset('storage/web.jpg') }}" alt="logo"
        </div>
    </div>
</body>
</html>
