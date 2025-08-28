<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <header class="mb-10">
            <h1 class="text-2xl font-extrabold text-[#FF2E2E]">
                NNCARRENT
            </h1>
        </header>
        <a href="{{ route('kategori') }}"
           class="fixed top-4 left-4 text-red-600 hover:text-red-800 inline-flex items-center justify-center z-50
                  text-base sm:text-lg font-semibold px-4 sm:px-6 py-2 sm:py-3 bg-white transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
        </a>

        <div class="flex flex-col lg:flex-row gap-10 lg:gap-20 mt-12">
            <section class="lg:flex-1 max-w-lg">
                <h2 class="text-xl font-semibold text-gray-700 mb-1">
                    Form Pemesanan
                </h2>
                <p class="text-xs text-gray-400 mb-6">
                    Lengkapi data diri Anda untuk melanjutkan pemesanan
                </p>
                <form action="{{ route('datadiri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input name="mobil_id" type="hidden" value="{{ $mobil->ID_Mobil }}" />

                    {{-- Nama Pelanggan --}}
                    <div>
                        <label for="customer_name" class="block text-sm mb-1">Nama Pelanggan</label>
                        <input id="customer_name" name="customer_name" required type="text"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                               value="{{ old('customer_name') }}" />
                        @error('customer_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone_number" class="block text-sm mb-1">Nomor Telepon</label>
                        <input id="phone_number" name="phone_number" required type="text"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                               value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}" />
                        @error('phone_number')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="phone_number_error" class="text-red-600 text-sm" style="display:none;">
                            Nomor telepon harus sesuai dengan akun Anda.
                        </span>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm mb-1">Email</label>
                        <input id="email" name="email" required type="email"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                               value="{{ old('email', Auth::user()->email ?? '') }}" />
                        @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="email_error" class="text-red-600 text-sm" style="display:none;">
                            Email harus sesuai dengan akun Anda.
                        </span>
                    </div>

                    {{-- Tanggal Sewa & Pengembalian --}}
                    <div class="flex gap-6">
                        <div class="flex-1">
                            <label for="rental_date" class="block text-sm mb-1">Tanggal Sewa</label>
                            <input id="rental_date" name="rental_date" required type="date"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                   value="{{ old('rental_date') }}" min="" />
                            @error('rental_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                            <span id="rental_date_error" class="text-red-600 text-xs" style="display:none;">
                                Tanggal sewa harus minimal 2 hari dari hari ini.
                            </span>
                        </div>
                        <div class="flex-1">
                            <label for="return_date" class="block text-sm mb-1">Tanggal Pengembalian</label>
                            <input id="return_date" name="return_date" required type="date"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                   value="{{ old('return_date') }}" />
                            @error('return_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                            <span id="return_date_error" class="text-red-600 text-xs" style="display:none;">
                                Tanggal pengembalian harus setelah tanggal sewa.
                            </span>
                        </div>
                    </div>

                    {{-- Metode Pengambilan --}}
                    <div class="mt-4">
                        <label class="block text-sm mb-1">Metode Pengambilan Mobil</label>
                        <div class="flex items-center gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="pickup_method" value="ambil-garasi" 
                                       class="form-radio text-[#FF2E2E]"
                                       {{ old('pickup_method', 'ambil-garasi')=='ambil-garasi'?'checked':'' }} />
                                <span class="ml-2 text-sm">Ambil di Garasi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="pickup_method" value="antar-jemput" 
                                       class="form-radio text-[#FF2E2E]"
                                       {{ old('pickup_method')=='antar-jemput'?'checked':'' }} />
                                <span class="ml-2 text-sm">Antar Jemput</span>
                            </label>
                        </div>
                    </div>

                    {{-- Lokasi Antar/Jemput --}}
                    <div id="antarJemputLocations" class="mt-4 space-y-4" style="display:none;">
                        <div>
                            <label for="lokasi_antar" class="block text-sm mb-1">Lokasi Antar</label>
                            <input id="lokasi_antar" name="lokasi_antar" type="text"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                   value="{{ old('lokasi_antar') }}" />
                            <span id="lokasi_antar_error" class="text-red-600 text-sm" style="display:none;">
                                Lokasi antar wajib diisi.
                            </span>
                        </div>
                        <div>
                            <label for="lokasi_jemput" class="block text-sm mb-1">Lokasi Jemput</label>
                            <input id="lokasi_jemput" name="lokasi_jemput" type="text"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                   value="{{ old('lokasi_jemput') }}" />
                            <span id="lokasi_jemput_error" class="text-red-600 text-sm" style="display:none;">
                                Lokasi jemput wajib diisi.
                            </span>
                        </div>
                    </div>

                    {{-- Upload KTP, SIM, Bukti --}}
                    <div>
                        <label for="ktp_photo" class="block text-sm mb-1">Foto KTP</label>
                        <input id="ktp_photo" name="ktp_photo" required type="file" accept=".jpg,.jpeg,.png"
                               class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" />
                        @error('ktp_photo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="ktp_photo_error" class="text-red-600 text-sm" style="display:none;">
                            File KTP harus JPG/PNG ≤2MB.
                        </span>
                    </div>
                    <div>
                        <label for="sim_photo" class="block text-sm mb-1">Foto SIM</label>
                        <input id="sim_photo" name="sim_photo" required type="file" accept=".jpg,.jpeg,.png"
                               class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" />
                        @error('sim_photo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="sim_photo_error" class="text-red-600 text-sm" style="display:none;">
                            File SIM harus JPG/PNG ≤2MB.
                        </span>
                    </div>
                    <div>
                        <label for="bukti_pembayaran" class="block text-sm mb-1">Bukti Pembayaran</label>
                        <input id="bukti_pembayaran" name="bukti_pembayaran" required type="file" accept=".jpg,.jpeg,.png,.pdf"
                               class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" />
                        @error('bukti_pembayaran')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="bukti_pembayaran_error" class="text-red-600 text-sm" style="display:none;">
                            File bukti harus JPG/PNG/PDF ≤2MB.
                        </span>
                    </div>

                    {{-- Instruksi --}}
                    <p class="text-sm mt-1 font-bold text-gray-800">
                        *TRANSFER HANYA DI REKENING INI (1801344025) BCA ACHMAD EFENDI WIJAYA
                    </p>
                    <p class="text-sm mt-1 font-bold text-gray-800">
                        *TRANSFER SESUAI TOTAL BAYAR DI BAWAH
                    </p>
                    <p class="text-sm mt-1 font-bold text-gray-800">
                        *PASTIKAN DATA YANG DIISI SUDAH BENAR
                    </p>

                    {{-- Ringkasan Harga --}}
                    <div class="text-sm space-y-1">
                        <p>
                            Harga Sewa per Hari: 
                            <span class="font-semibold">Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                        </p>
                        <p>
                            Total Bayar: 
                            <span id="total_bayar" class="font-semibold text-[#FF2E2E]">
                                Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}
                            </span>
                        </p>
                        <p id="pesan-konfirmasi" class="mt-2 text-green-600 font-semibold">
                            Dokumen KTP, SIM, dan Bukti Pembayaran Anda akan diverifikasi oleh admin.
                        </p>
                    </div>

                    {{-- HIDDEN INPUT UNTUK TOTAL BAYAR --}}
                    <input type="hidden" id="total_bayar_input" name="total_bayar" value="">

                    {{-- Tombol Submit --}}
                    <button id="submit_button" type="submit" disabled
                            class="w-full bg-[#FF2E2E] text-white rounded-md py-3 text-sm shadow-md hover:bg-[#e02626] transition">
                        Konfirmasi Pesanan
                    </button>
                </form>
            </section>

            {{-- Preview Mobil --}}
            <aside class="lg:w-[400px] bg-[#655f5f] rounded-md flex flex-col items-center py-8 px-6 text-center text-white">
                <img alt="{{ $mobil->Merek }} {{ $mobil->Model }}" src="{{ asset($mobil->Foto) }}"
                     class="mb-8" width="300" height="150" />
                <h3 class="text-2xl font-extrabold text-[#FF2E2E] mb-2">
                    {{ $mobil->Merek }} {{ $mobil->Model }}
                </h3>
                <div class="flex justify-center items-center gap-1 mb-1">
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="far fa-star text-yellow-400"></i>
                    <span class="text-xs text-gray-300 ml-2">(20 Review)</span>
                </div>
                <div class="flex justify-center items-center gap-6 text-xs mb-4">
                    <div class="flex items-center gap-1">
                        <i class="fas fa-user"></i>
                        <span>{{ $mobil->Jumlah_Kursi }}</span>
                    </div>
                    <span>MPV</span>
                </div>
                <p class="text-xs mb-6"><span class="font-semibold">Manual</span></p>
                <p class="text-xs font-semibold mb-6">Tanpa Driver</p>
                <div class="bg-[#7a7474] rounded-md py-4 px-8 text-white text-lg font-extrabold">
                    <span class="text-[#FF6B00]">RP {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                    <span class="text-white">/ Hari</span>
                </div>
            </aside>
        </div>
    </div>

    <script>
    // Pass authenticated user data to JavaScript
    const authUser = {
        email: "{{ Auth::user()->email ?? '' }}",
        phone_number: "{{ Auth::user()->phone_number ?? '' }}"
    };

    // Variables
    const rentalDateInput = document.getElementById('rental_date');
    const returnDateInput = document.getElementById('return_date');
    const emailInput = document.getElementById('email');
    const phoneNumberInput = document.getElementById('phone_number');
    const ktpPhotoInput = document.getElementById('ktp_photo');
    const simPhotoInput = document.getElementById('sim_photo');
    const buktiPembayaranInput = document.getElementById('bukti_pembayaran');
    const totalBayarSpan = document.getElementById('total_bayar');
    const totalBayarInput = document.getElementById('total_bayar_input'); // Input hidden
    const rentalDateError = document.getElementById('rental_date_error');
    const returnDateError = document.getElementById('return_date_error');
    const emailError = document.getElementById('email_error');
    const phoneNumberError = document.getElementById('phone_number_error');
    const ktpPhotoError = document.getElementById('ktp_photo_error');
    const simPhotoError = document.getElementById('sim_photo_error');
    const buktiPembayaranError = document.getElementById('bukti_pembayaran_error');
    const submitButton = document.getElementById('submit_button');

    const biayaAntarJemput = 50000; // Biaya antar-jemput Rp50.000
    const hargaSewa = {{ $mobil->Harga_Sewa }};
    const pickupMethodRadios = document.querySelectorAll('input[name="pickup_method"]');
    const antarJemputLocations = document.getElementById('antarJemputLocations');
    const lokasiAntarInput = document.getElementById('lokasi_antar');
    const lokasiJemputInput = document.getElementById('lokasi_jemput');
    const lokasiAntarError = document.getElementById('lokasi_antar_error');
    const lokasiJemputError = document.getElementById('lokasi_jemput_error');

    // Set minimum rental date (2 days from today)
    const today = new Date('{{ now()->setTimezone('Asia/Jakarta')->toDateTimeString() }}');
    const minRentalDate = new Date(today);
    minRentalDate.setDate(today.getDate() + 2);
    rentalDateInput.setAttribute('min', minRentalDate.toISOString().split('T')[0]);

    function normalizePhone(phone) {
        return phone.trim().replace(/^(\+62|62)/, '0');
    }

    function toggleAntarJemputFields() {
        const selected = document.querySelector('input[name="pickup_method"]:checked').value;
        if (selected === 'antar-jemput') {
            antarJemputLocations.style.display = 'block';
        } else {
            antarJemputLocations.style.display = 'none';
            lokasiAntarError.style.display = 'none';
            lokasiJemputError.style.display = 'none';
            lokasiAntarInput.value = '';
            lokasiJemputInput.value = '';
        }
        validateForm(); // Update total saat metode berubah
    }

    function validateForm() {
        try {
            const rentalDate = new Date(rentalDateInput.value);
            const returnDate = new Date(returnDateInput.value);
            const email = emailInput.value;
            const phoneNumber = phoneNumberInput.value;
            const ktpFile = ktpPhotoInput.files[0];
            const simFile = simPhotoInput.files[0];
            const buktiPembayaranFile = buktiPembayaranInput.files[0];
            let isValid = true;

            // Validasi tanggal sewa
            if (rentalDate && rentalDate < minRentalDate) {
                rentalDateError.style.display = 'block';
                isValid = false;
            } else {
                rentalDateError.style.display = 'none';
            }

            // Validasi tanggal pengembalian
            if (rentalDate && returnDate && returnDate <= rentalDate) {
                returnDateError.style.display = 'block';
                isValid = false;
            } else {
                returnDateError.style.display = 'none';
            }

            // Validasi email
            const inputEmail = email.trim().toLowerCase();
            const storedEmail = authUser.email.trim().toLowerCase();
            if (storedEmail && inputEmail !== storedEmail) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            // Validasi nomor telepon
            const inputPhone = normalizePhone(phoneNumber);
            const storedPhone = normalizePhone(authUser.phone_number);
            if (storedPhone && inputPhone !== storedPhone) {
                phoneNumberError.style.display = 'block';
                isValid = false;
            } else {
                phoneNumberError.style.display = 'none';
            }

            // Validasi file KTP
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (ktpFile) {
                if (!validImageTypes.includes(ktpFile.type) || ktpFile.size > maxSize) {
                    ktpPhotoError.style.display = 'block';
                    isValid = false;
                } else {
                    ktpPhotoError.style.display = 'none';
                }
            }

            // Validasi file SIM
            if (simFile) {
                if (!validImageTypes.includes(simFile.type) || simFile.size > maxSize) {
                    simPhotoError.style.display = 'block';
                    isValid = false;
                } else {
                    simPhotoError.style.display = 'none';
                }
            }

            // Validasi bukti pembayaran
            const validPaymentTypes = [...validImageTypes, 'application/pdf'];
            if (buktiPembayaranFile) {
                if (!validPaymentTypes.includes(buktiPembayaranFile.type) || buktiPembayaranFile.size > maxSize) {
                    buktiPembayaranError.style.display = 'block';
                    isValid = false;
                } else {
                    buktiPembayaranError.style.display = 'none';
                }
            }

            // Validasi lokasi antar-jemput
            const pickupMethod = document.querySelector('input[name="pickup_method"]:checked').value;
            if (pickupMethod === 'antar-jemput') {
                let lokasiValid = true;
                if (!lokasiAntarInput.value.trim()) {
                    lokasiAntarError.style.display = 'block';
                    lokasiValid = false;
                } else {
                    lokasiAntarError.style.display = 'none';
                }
                if (!lokasiJemputInput.value.trim()) {
                    lokasiJemputError.style.display = 'block';
                    lokasiValid = false;
                } else {
                    lokasiJemputError.style.display = 'none';
                }
                if (!lokasiValid) {
                    isValid = false;
                }
            }

            // Hitung total harga
            if (isValid && rentalDate && returnDate && returnDate > rentalDate) {
                const durasiSewa = Math.ceil((returnDate - rentalDate) / (1000 * 60 * 60 * 24));
                let total = hargaSewa * durasiSewa;

                if (pickupMethod === 'antar-jemput') {
                    total += biayaAntarJemput; // Tambah Rp50.000 untuk antar-jemput
                    totalBayarSpan.textContent = `Rp ${total.toLocaleString('id-ID')} (+ Rp ${biayaAntarJemput.toLocaleString('id-ID')})`;
                } else {
                    totalBayarSpan.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                }

                // Simpan total ke input hidden
                totalBayarInput.value = total;
            } else {
                totalBayarSpan.textContent = `Rp ${hargaSewa.toLocaleString('id-ID')}`;
                totalBayarInput.value = hargaSewa; // Default ke harga sewa jika invalid
            }

            submitButton.disabled = !isValid;
        } catch (error) {
            console.error('Validation error:', error);
            submitButton.disabled = true;
        }
    }

    // Event listeners
    rentalDateInput.addEventListener('change', () => {
        const rentalDate = new Date(rentalDateInput.value);
        const minReturnDate = new Date(rentalDate);
        minReturnDate.setDate(rentalDate.getDate() + 1);
        returnDateInput.setAttribute('min', minReturnDate.toISOString().split('T')[0]);
        validateForm();
    });

    pickupMethodRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            toggleAntarJemputFields();
            validateForm();
        });
    });

    lokasiAntarInput.addEventListener('input', validateForm);
    lokasiJemputInput.addEventListener('input', validateForm);

    rentalDateInput.addEventListener('change', validateForm);
    returnDateInput.addEventListener('change', validateForm);
    emailInput.addEventListener('input', validateForm);
    phoneNumberInput.addEventListener('input', validateForm);
    ktpPhotoInput.addEventListener('change', validateForm);
    simPhotoInput.addEventListener('change', validateForm);
    buktiPembayaranInput.addEventListener('change', validateForm);

    // Jalankan saat halaman load
    toggleAntarJemputFields();
    validateForm();

    document.querySelector('form').addEventListener('submit', e => {
        console.log('Form submitted');
    });
</script>