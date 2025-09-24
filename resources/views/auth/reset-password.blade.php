<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - NNCARRENT</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- PT Sans Font -->
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
  <style>
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
      background: #fff;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
      margin-bottom: 30px;
      line-height: 1.6;
      text-align: center;
    }
    .form-control {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 12px;
      margin-bottom: 20px;
    }
    .btn-reset {
      background: #f62f32;
      color: white;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
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
  <!-- Logo di pojok kiri atas -->
  <div class="nncarrent-header">
    <a href="{{ route('home') }}" style="color: inherit; text-decoration: none;">NNCARRENT</a>
  </div>

  <div class="password-container">
    <h2 class="password-title">Lupa Password?</h2>
    <p class="password-text">
      Silahkan masukkan password baru kamu
    </p>

    <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="email" value="{{ session('email') }}">

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn-reset">Reset Password</button>
</form>




    <div class="back-login">
      <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>