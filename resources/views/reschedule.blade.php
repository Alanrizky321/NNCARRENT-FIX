<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Pemesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 30px;
        }
        .card {
            max-width: 700px;
            margin: auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin-bottom: 20px;
            color: #f62f32;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #fdfdfd;
        }
        input[readonly], select[disabled] {
            background: #e9ecef;
            cursor: not-allowed;
        }
        .btn {
            background: #f62f32;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #d62528;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }
        .back-link:hover {
            color: #f62f32;
        }
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Reschedule Pemesanan</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($pesanan->status === 'on_going')
            <form action="{{ route('pesanan.updateReschedule', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Mobil -->
                <div class="form-group">
                    <label>Mobil</label>
                    <input type="text" value="{{ $pesanan->mobil ? $pesanan->mobil->Merek.' '.$pesanan->mobil->Model : 'Mobil tidak ditemukan' }}" readonly>
                </div>

                <!-- Harga -->
                <div class="form-group">
                    <label>Total Harga</label>
                    <input type="text" value="Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}" readonly>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="{{ ucfirst($pesanan->status) }}" readonly>
                </div>

                <!-- Tanggal Mulai -->
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pesanan->tanggal_mulai) }}" required onchange="updateMinEndDate()">
                </div>

                <!-- Tanggal Selesai -->
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pesanan->tanggal_selesai) }}" required>
                </div>

                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
        @else
            <div class="alert">
                Pesanan ini tidak dapat di-reschedule karena statusnya "{{ $pesanan->status }}" (harus "On Going").
            </div>
        @endif

        <a href="{{ route('riwayat') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <script>
        function updateMinEndDate() {
            const startDate = document.getElementById('tanggal_mulai').value;
            if (startDate) {
                const minEndDate = new Date(startDate);
                minEndDate.setDate(minEndDate.getDate() + 1); // Tambah 1 hari
                const minEndDateStr = minEndDate.toISOString().split('T')[0];
                document.getElementById('tanggal_selesai').setAttribute('min', minEndDateStr);
            }
        }

        // Panggil saat halaman dimuat untuk set nilai awal
        window.onload = function() {
            updateMinEndDate();
        };
    </script>
</body>
</html>