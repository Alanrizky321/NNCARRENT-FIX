<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - NNCARRENT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- PT Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Logo kiri atas */
        .nncarrent-header {
            position: fixed;
            top: 20px;
            left: 30px;
            font-family: 'PT Sans', sans-serif;
            font-size: 28px;
            font-weight: bold;
            color: #f62f32;
        }

        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'PT Sans', sans-serif;
        }

        .password-container {
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
        }

        .password-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }

        .password-text {
            color: #666;
            margin-bottom: 50px;
            line-height: 1.6;
            text-align: center;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-reset {
            background: #f62f32;
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            text-align: center;
        }

        .btn-reset:hover {
            background: #d10000;
        }

        .back-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-login a {
            color: #f62f32;
            text-decoration: none;
            font-weight: 500;
        }

        .back-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Logo kiri atas -->
    <div class="nncarrent-header">
        <a href="{{ route('home') }}" style="color: inherit; text-decoration: none;">NNCARRENT</a>
    </div>

    <div class="password-container">
        <h2 class="password-title">Lupa Password?</h2>
        <p class="password-text">
            Mohon masukkan alamat email Anda pada formulir di bawah ini.
            Jika email tersebut telah terdaftar, kami akan memberkan akses
            untuk memperbarui password anda.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <input
            type="email"
            class="form-control"
            name="email"
            placeholder="Masukkan email kamu"
            required
        >
        </div>
        <button type="submit" class="btn-reset">Reset Password</button>
        </form>

        @if ($errors->has('email'))
    <div class="alert alert-danger">
        <strong>{{ $errors->first('email') }}</strong>
    </div>
@endif


        <div class="back-login">
            <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
