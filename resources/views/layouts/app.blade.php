<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'NNCarRent')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Atau kalau pakai PNG -->
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function konfirmasiVerifikasi(id, status) {
    let pesan = status === 'approved' 
        ? 'Apakah Anda yakin ingin menyetujui pesanan ini?' 
        : 'Apakah Anda yakin ingin menolak pesanan ini?';

    Swal.fire({
        title: 'Konfirmasi',
        text: pesan,
        icon: status === 'approved' ? 'question' : 'warning',
        showCancelButton: true,
        confirmButtonColor: status === 'approved' ? '#4CAF50' : '#FF3B2F',
        cancelButtonColor: '#6c757d',
        confirmButtonText: status === 'approved' ? 'Ya, Setujui' : 'Ya, Tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            if (status === 'rejected') {
                Swal.fire({
                    title: 'Alasan Penolakan',
                    input: 'text',
                    inputPlaceholder: 'Masukkan alasan penolakan...',
                    showCancelButton: true,
                    confirmButtonText: 'Kirim',
                    cancelButtonText: 'Batal'
                }).then((inputResult) => {
                    if (inputResult.isConfirmed) {
                        document.getElementById('status-' + id).value = status;
                        document.getElementById('alasan-' + id).value = inputResult.value || '';
                        document.getElementById('form-verifikasi-' + id).submit();
                    }
                });
            } else {
                document.getElementById('status-' + id).value = status;
                document.getElementById('form-verifikasi-' + id).submit();
            }
        }
    });
}
</script>

<body>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
