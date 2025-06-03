<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>NNCarRent</title>
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
        <a href="{{ route('kategori') }}" class="fixed top-4 left-4 text-red-600 hover:text-red-800 inline-flex items-center justify-center z-50 text-base sm:text-lg font-semibold px-4 sm:px-6 py-2 sm:py-3 bg-white transition-all duration-200">
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

                    <div>
                        <label class="block text-sm mb-1" for="customer_name">Nama Pelanggan</label>
                        <input class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="customer_name" name="customer_name" required type="text" value="{{ old('customer_name') }}" />
                        @error('customer_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1" for="phone_number">Nomor Telepon</label>
                        <input class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="phone_number" name="phone_number" required type="text" value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}" />
                        @error('phone_number')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="phone_number_error" class="text-red-600 text-sm" style="display:none;">
                            Nomor telepon harus sesuai dengan akun Anda.
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm mb-1" for="email">Email</label>
                        <input class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="email" name="email" required type="email" value="{{ old('email', Auth::user()->email ?? '') }}" />
                        @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="email_error" class="text-red-600 text-sm" style="display:none;">
                            Email harus sesuai dengan akun Anda.
                        </span>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-1">
                            <label class="block text-sm mb-1" for="rental_date">Tanggal Sewa</label>
                            <input class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                                   id="rental_date" name="rental_date" required type="date" value="{{ old('rental_date') }}" min="" />
                            @error('rental_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                            <span id="rental_date_error" class="text-red-600 text-xs" style="display:none;">
                                Tanggal sewa harus minimal 2 hari dari hari ini.
                            </span>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm mb-1" for="return_date">Tanggal Pengembalian</label>
                            <input class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                                   id="return_date" name="return_date" required type="date" value="{{ old('return_date') }}" />
                            @error('return_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                            <span id="return_date_error" class="text-red-600 text-xs" style="display:none;">
                                Tanggal pengembalian harus setelah tanggal sewa.
                            </span>
                        </div>
                    </div>

                    <!-- Metode Pengambilan Mobil -->
                    <div class="mt-4">
                        <label class="block text-sm mb-1">Metode Pengambilan Mobil</label>
                        <div class="flex items-center gap-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="pickup_method" value="ambil-garasi" 
                                    class="form-radio text-[#FF2E2E]"
                                    {{ old('pickup_method', 'ambil-garasi') == 'ambil-garasi' ? 'checked' : '' }} />
                                <span class="ml-2 text-sm">Ambil di Garasi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="pickup_method" value="antar-jemput" 
                                    class="form-radio text-[#FF2E2E]" 
                                    {{ old('pickup_method') == 'antar-jemput' ? 'checked' : '' }} />
                                <span class="ml-2 text-sm">Antar Jemput</span>
                            </label>
                        </div>
                    </div>

                    <!-- Lokasi Antar Jemput -->
                    <div id="antarJemputLocations" class="mt-4 space-y-4" style="display:none;">
                        <div>
                            <label class="block text-sm mb-1" for="lokasi_antar">Lokasi Antar</label>
                            <input id="lokasi_antar" name="lokasi_antar" type="text"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                placeholder="Masukkan lokasi antar"
                                value="{{ old('lokasi_antar') }}" />
                            <span id="lokasi_antar_error" class="text-red-600 text-sm" style="display:none;">
                                Lokasi antar wajib diisi.
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm mb-1" for="lokasi_jemput">Lokasi Jemput</label>
                            <input id="lokasi_jemput" name="lokasi_jemput" type="text"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]"
                                placeholder="Masukkan lokasi jemput"
                                value="{{ old('lokasi_jemput') }}" />
                            <span id="lokasi_jemput_error" class="text-red-600 text-sm" style="display:none;">
                                Lokasi jemput wajib diisi.
                            </span>
                        </div>
                    </div>

                    <!-- Upload KTP -->
                    <div>
                        <label class="block text-sm mb-1" for="ktp_photo">Foto KTP</label>
                        <input accept=".jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="ktp_photo" name="ktp_photo" required type="file" />
                        @error('ktp_photo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="ktp_photo_error" class="text-red-600 text-sm" style="display:none;">
                            File KTP harus berupa JPG/PNG dan maksimum 2MB.
                        </span>
                    </div>

                    <!-- Upload SIM -->
                    <div>
                        <label class="block text-sm mb-1" for="sim_photo">Foto SIM</label>
                        <input accept=".jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="sim_photo" name="sim_photo" required type="file" />
                        @error('sim_photo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="sim_photo_error" class="text-red-600 text-sm" style="display:none;">
                            File SIM harus berupa JPG/PNG dan maksimum 2MB.
                        </span>
                    </div>

                    <!-- Upload Bukti Pembayaran -->
                    <div>
                        <label class="block text-sm mb-1" for="bukti_pembayaran">Bukti Pembayaran</label>
                        <input accept=".jpg,.jpeg,.png,.pdf" class="w-full border border-gray-300 rounded-md px-3 py-6 text-xs text-gray-400 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF2E2E]" 
                               id="bukti_pembayaran" name="bukti_pembayaran" required type="file" />
                        @error('bukti_pembayaran')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span id="bukti_pembayaran_error" class="text-red-600 text-sm" style="display:none;">
                            File bukti pembayaran harus berupa JPG/PNG/PDF dan maksimum 2MB.
                        </span>
                    </div>
                    <p class="text-sm mt-1 font-bold text-gray-800">
    *TRANSFER HANYA DI REKENING INI  <span>(1801344025) BCA ACHMAD EFENDI WIJAYA</span>
</p>

<p class="text-sm mt-1 font-bold text-gray-800">
    *TRANSFER SESUAI TOTAL BAYAR DI BAWAH</span>
</p>
<p class="text-sm mt-1 font-bold text-gray-800">
    *PASTIKAN DATA YANG DIISI SUDAH BENAR</span>
</p>


                    <div class="text-sm space-y-1">
                        <p>
                            Harga Sewa per Hari: <span class="font-semibold">Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                        </p>
                        <p>
                            Total Bayar: <span id="total_bayar" class="font-semibold text-[#FF2E2E]">Rp {{ number_format($mobil->Harga_Sewa, 0, ',', '.') }}</span>
                        </p>
                        <p id="pesan-konfirmasi" class="mt-2 text-green-600 font-semibold">
                            Dokumen KTP, SIM, dan Bukti Pembayaran Anda akan diverifikasi oleh admin.
                        </p>
                    </div>

                    <button id="submit_button" class="w-full bg-[#FF2E2E] text-white rounded-md py-3 text-sm font-normal shadow-md hover:bg-[#e02626] transition" type="submit" disabled>
                        Konfirmasi Pesanan
                    </button>
                </form>
            </section>
            <aside class="lg:w-[400px] bg-[#655f5f] rounded-md flex flex-col items-center py-8 px-6 text-center text-white">
                <img alt="White Toyota Alphard car angled front view on gray background" class="mb-8" height="150" src="{{ asset($mobil->Foto) }}" width="300" />
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
                <p class="text-xs mb-6">
                    <span class="font-semibold">Manual</span>
                </p>
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
    const rentalDateError = document.getElementById('rental_date_error');
    const returnDateError = document.getElementById('return_date_error');
    const emailError = document.getElementById('email_error');
    const phoneNumberError = document.getElementById('phone_number_error');
    const ktpPhotoError = document.getElementById('ktp_photo_error');
    const simPhotoError = document.getElementById('sim_photo_error');
    const buktiPembayaranError = document.getElementById('bukti_pembayaran_error');
    const submitButton = document.getElementById('submit_button');

    const biayaAntarJemput = 50000;
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

            if (rentalDate && rentalDate < minRentalDate) {
                rentalDateError.style.display = 'block';
                isValid = false;
            } else {
                rentalDateError.style.display = 'none';
            }

            if (rentalDate && returnDate && returnDate <= rentalDate) {
                returnDateError.style.display = 'block';
                isValid = false;
            } else {
                returnDateError.style.display = 'none';
            }

            const inputEmail = email.trim().toLowerCase();
            const storedEmail = authUser.email.trim().toLowerCase();
            if (storedEmail && inputEmail !== storedEmail) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            const inputPhone = normalizePhone(phoneNumber);
            const storedPhone = normalizePhone(authUser.phone_number);
            if (storedPhone && inputPhone !== storedPhone) {
                phoneNumberError.style.display = 'block';
                isValid = false;
            } else {
                phoneNumberError.style.display = 'none';
            }

            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const maxSize = 2 * 1024 * 1024;

            if (ktpFile) {
                if (!validImageTypes.includes(ktpFile.type) || ktpFile.size > maxSize) {
                    ktpPhotoError.style.display = 'block';
                    isValid = false;
                } else {
                    ktpPhotoError.style.display = 'none';
                }
            }

            if (simFile) {
                if (!validImageTypes.includes(simFile.type) || simFile.size > maxSize) {
                    simPhotoError.style.display = 'block';
                    isValid = false;
                } else {
                    simPhotoError.style.display = 'none';
                }
            }

            const validPaymentTypes = [...validImageTypes, 'application/pdf'];
            if (buktiPembayaranFile) {
                if (!validPaymentTypes.includes(buktiPembayaranFile.type) || buktiPembayaranFile.size > maxSize) {
                    buktiPembayaranError.style.display = 'block';
                    isValid = false;
                } else {
                    buktiPembayaranError.style.display = 'none';
                }
            }

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

            if (isValid && rentalDate && returnDate && returnDate > rentalDate) {
                const durasiSewa = Math.ceil((returnDate - rentalDate) / (1000 * 60 * 60 * 24));
                let total = hargaSewa * durasiSewa;

                if (pickupMethod === 'antar-jemput') {
                    total += biayaAntarJemput;
                    totalBayarSpan.textContent = `Rp ${total.toLocaleString('id-ID')} (+ Rp ${biayaAntarJemput.toLocaleString('id-ID')})`;
                } else {
                    totalBayarSpan.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                }
            } else {
                totalBayarSpan.textContent = `Rp ${hargaSewa.toLocaleString('id-ID')}`;
            }

            submitButton.disabled = !isValid;
        } catch (error) {
            console.error('Validation error:', error);
            submitButton.disabled = true;
        }
    }

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

</body>
</html>
