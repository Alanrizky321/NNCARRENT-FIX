<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Pesan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Admin;
use Tests\TestCase;

class rescheduleTest extends TestCase
{

    use RefreshDatabase;
    protected $pesans;
    protected $token;
    protected $user;
    protected $admin;
    protected $mobil;
    protected $kategori;

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
        $this->pesans = Pesan::create([
            'mobil_id' => $this->mobil->ID_Mobil,
            'user_id' => $this->user->ID_Pelanggan,
            'nama_pelanggan' => 'Ahmad Romi',
            'nomor_hp' => '089510694911',
            'email' => 'ahmadroni12@gmail.com',
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-10',
            'ktp_photo_path' => 'path_ktp_dummy.jpg',
            'ktp_sim_path' => 'path_sim_dummy.jpg',
            'bukti_pembayaran_path' => 'path_bukti_pembayaran_dummy.jpg',
            'antar_jemput' => 'ambil-garasi',
        ]);

        $this->token = 'testingtoken1234';
    }
    /** @test */
    public function emptyEmail()
    {
        $response = $this->from(route('pesanan.reschedule', $this->pesans->id))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', $this->pesans->id), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-07',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pesanan.reschedule'));
        $this->assertDatabaseHas('pesans', ['tanggal_selesai' => '2025-12-07']);
    }
}
