<!-- Sesuaikan dengan styling login page Anda -->
<div class="container-login">
    <div class="login-form">
        <h1>NNCARRENT</h1>
        <h2>Reset Password</h2>
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">
                Kirim Link Reset Password
            </button>
        </form>
        
        <div class="footer mt-3">
            <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </div>
    <div class="login-logo">
        <img src="web.jpg" alt="NN Family Trans Wisata">
    </div>
</div>