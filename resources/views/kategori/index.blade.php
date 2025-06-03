<!DOCTYPE html>
<html>
<head><title>Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Data Kategori</h2>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>
   

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead><tr><th>ID</th><th>Nama Kategori</th></tr></thead>
        <tbody>
        @foreach($kategori as $k)
            <tr>
                <td>{{ $k->id }}</td>
                <td>{{ $k->Nama_Kategori }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
