<div class="container-login">
    <div class="login-form">
        <h1>NNCARRENT</h1>
        <h2>Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ $email ?? old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <input type="password" class="form-control" 
                       id="password-confirm" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-login">
                Reset Password
            </button>
        </form>
    </div>
    <div class="login-logo">
        <img src="web.jpg" alt="NN Family Trans Wisata">
    </div>
</div>