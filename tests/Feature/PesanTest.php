<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Pesan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Admin;
use Tests\TestCase;

class PesanTest extends TestCase
{
    use RefreshDatabase;
    protected $pesans;
    protected $token;
    protected $user;
    protected $admin;
    protected $mobil;
    protected $kategori;
    protected $testCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::create([
            'email' => 'admin@gmail.com',
            'no_hp' => '0928310213',
            'password' => bcrypt('password123'),
        ]);
        $this->user = Pelanggan::create([
            'no_hp' => '0812345678910',
            'email' => 'rifqi2@gmail.com',
            'password' => bcrypt('api123!'),
        ]);
        $this->kategori = Kategori::create([
            'Nama_Kategori' => 'SUV'
        ]);
        $this->mobil = Mobil::create([
            'Merek' => 'Daihatsu',
            'Model' => 'Alya',
            'Tahun' => 2004,
            'Harga_Sewa' => 300000,
            'Kategori_ID' => $this->kategori->id,
            'ID_Admin' => $this->admin->ID_Admin,
            'Jumlah_Kursi' => 4,
            'Jenis_Transmisi' => 'manual',
        ]);

        $this->token = 'testingtoken1234';
    }
     /** @test */
    public function validCustomerName()
    {
        $this->actingAs($this->user, 'pelanggan');
        Storage::fake('public');
        $filektp = UploadedFile::fake()->create('path_ktp_dummy.jpg', 100);
        $filesim = UploadedFile::fake()->create('path_sim_dummy.jpg', 100);
        $filetransfer = UploadedFile::fake()->create('path_bukti_pembayaran_dummy.jpg', 100);
        $response = $this->from(route('booking.create', $this->mobil->ID_Mobil))->withSession(['_token' => $this->token])
        ->post(route('booking.store', $this->mobil->ID_Mobil), [
            '_token' => $this->token,
            'mobil_id' => $this->mobil->ID_Mobil,
            'customer_name' => 'Okta Hidayat',
            'phone_number' => '089510694911',
            'email' => 'oktahidayat12@gmail.com',
            'rental_date' => '2025-12-05',
            'return_date' => '2025-12-10',
            'ktp_photo' => $filektp,
            'sim_photo' => $filesim,
            'bukti_pembayaran' => $filetransfer,
            'pickup_method' => 'ambil-garasi',
            'total_bayar' => 1500000,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pesans', ['nama_pelanggan' => 'Okta Hidayat']);
    }
     /** @test */
    public function emptyCustomerName()
    {
        $this->actingAs($this->user, 'pelanggan');
        Storage::fake('public');
        $filektp = UploadedFile::fake()->create('path_ktp_dummy.jpg', 100);
        $filesim = UploadedFile::fake()->create('path_sim_dummy.jpg', 100);
        $filetransfer = UploadedFile::fake()->create('path_bukti_pembayaran_dummy.jpg', 100);
        $response = $this->from(route('booking.create', $this->mobil->ID_Mobil))->withSession(['_token' => $this->token])
        ->post(route('booking.store', $this->mobil->ID_Mobil), [
            '_token' => $this->token,
            'mobil_id' => $this->mobil->ID_Mobil,
            'customer_name' => '',
            'phone_number' => '089510694911',
            'email' => 'ahmadroni12@gmail.com',
            'rental_date' => '2025-12-05',
            'return_date' => '2025-12-10',
            'ktp_photo' => $filektp,
            'sim_photo' => $filesim,
            'bukti_pembayaran' => $filetransfer,
            'pickup_method' => 'ambil-garasi',
            'total_bayar' => 1500000,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('booking.create', $this->mobil->ID_Mobil));
        $response->assertSessionHasErrors(['customer_name']);
    }
     /** @test */
    public function validNumericPhone()
    {
        $this->actingAs($this->user, 'pelanggan');
        Storage::fake('public');
        $filektp = UploadedFile::fake()->create('path_ktp_dummy.jpg', 100);
        $filesim = UploadedFile::fake()->create('path_sim_dummy.jpg', 100);
        $filetransfer = UploadedFile::fake()->create('path_bukti_pembayaran_dummy.jpg', 100);
        $response = $this->from(route('booking.create', $this->mobil->ID_Mobil))->withSession(['_token' => $this->token])
        ->post(route('booking.store', $this->mobil->ID_Mobil), [
            '_token' => $this->token,
            'mobil_id' => $this->mobil->ID_Mobil,
            'customer_name' => 'Ahmad Roni',
            'phone_number' => '08122467897',
            'email' => 'ahmadroni12@gmail.com',
            'rental_date' => '2025-12-05',
            'return_date' => '2025-12-10',
            'ktp_photo' => $filektp,
            'sim_photo' => $filesim,
            'bukti_pembayaran' => $filetransfer,
            'pickup_method' => 'ambil-garasi',
            'total_bayar' => 1500000,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pesans', ['nomor_hp' => '08122467897']);
    }
     /** @test */
    public function phoneNumberWithAlphabet()
    {
        $this->actingAs($this->user, 'pelanggan');
        Storage::fake('public');
        $filektp = UploadedFile::fake()->create('path_ktp_dummy.jpg', 100);
        $filesim = UploadedFile::fake()->create('path_sim_dummy.jpg', 100);
        $filetransfer = UploadedFile::fake()->create('path_bukti_pembayaran_dummy.jpg', 100);
        $response = $this->from(route('booking.create', $this->mobil->ID_Mobil))->withSession(['_token' => $this->token])
        ->post(route('booking.store', $this->mobil->ID_Mobil), [
            '_token' => $this->token,
            'mobil_id' => $this->mobil->ID_Mobil,
            'customer_name' => 'Ahmad Roni',
            'phone_number' => '08122467abc',
            'email' => 'ahmadroni12@gmail.com',
            'rental_date' => '2025-12-05',
            'return_date' => '2025-12-10',
            'ktp_photo' => $filektp,
            'sim_photo' => $filesim,
            'bukti_pembayaran' => $filetransfer,
            'pickup_method' => 'ambil-garasi',
            'total_bayar' => 1500000,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('booking.create', $this->mobil->ID_Mobil));
        $response->assertSessionHasErrors(['phone_number']); 
    }
    public function validEmailFormat()
    {
        $this->actingAs($this->user, 'pelanggan');
        Storage::fake('public');
        $filektp = UploadedFile::fake()->create('path_ktp_dummy.jpg', 100);
        $filesim = UploadedFile::fake()->create('path_sim_dummy.jpg', 100);
        $filetransfer = UploadedFile::fake()->create('path_bukti_pembayaran_dummy.jpg', 100);
        $response = $this->from(route('booking.create', $this->mobil->ID_Mobil))->withSession(['_token' => $this->token])
        ->post(route('booking.store', $this->mobil->ID_Mobil), [
            '_token' => $this->token,
            'mobil_id' => $this->mobil->ID_Mobil,
            'customer_name' => 'Okta Hidayat',
            'phone_number' => '089510694911',
            'email' => 'oktahyt@gmail.com',
            'rental_date' => '2025-12-05',
            'return_date' => '2025-12-10',
            'ktp_photo' => $filektp,
            'sim_photo' => $filesim,
            'bukti_pembayaran' => $filetransfer,
            'pickup_method' => 'ambil-garasi',
            'total_bayar' => 1500000,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pesans', ['email' => 'oktahyt@gmail.com']);
    }

}
