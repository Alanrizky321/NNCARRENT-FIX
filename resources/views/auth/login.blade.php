<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NNCARRENT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .login-container h2 {
            text-align: center;
            color: #555;
            margin-bottom: 30px;
        }
        .login-container .form-group {
            margin-bottom: 20px;
        }
        .login-container .form-group label {
            font-weight: bold;
            color: #555;
        }
        .login-container .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .login-container .form-control:focus {
            border-color: #ff0000;
            box-shadow: none;
        }
        .login-container .checkbox {
            margin-bottom: 20px;
        }
        .login-container .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #f62f32;
            border: none;
            border-radius: 5px;
            color: #000000;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container .btn-login:hover {
            background-color: #b30000;
        }
        .login-container .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
        .login-container .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .login-container .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>NNCARRENT</h1>
        <h2>Log In</h2>
        <p>Silahkan Masukkan Informasi Akun kamu</p>

        <!-- Form Login -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email kamu" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
            </div>

            <!-- Checkbox dan Link Lupa Password -->
            <div class="form-group checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat Saya</label>
                <a href="#" style="float: right;">Lupa Password?</a>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-login">Login</button>
        </form>

        
        </div>
    </div>
</body>
</html>