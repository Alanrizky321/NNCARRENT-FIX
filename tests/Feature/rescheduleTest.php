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
            'total_harga' => 1500000,
        ]);

        $this->token = 'testingtoken1234';
    }
    /** @test */
    public function changeFinishDate()
    {
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-07',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('riwayat'));
        $this->assertDatabaseHas('pesans', ['tanggal_selesai' => '2025-12-07']);
    }
    /** @test */
    public function invalidSetStart()
    {
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-07',
            'tanggal_selesai' => '2025-12-05',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pesanan.reschedule', $this->pesans->id));
        $response->assertSessionHasErrors(['tanggal_selesai']);
    }
    /** @test */
    public function setPassedDate()
    {
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-10-25',
            'tanggal_selesai' => '2025-10-27',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pesanan.reschedule', $this->pesans->id));
        $response->assertSessionHasErrors(['tanggal_mulai']);
    }
    /** @test */
    public function periodFullBooking()
    {
        $user2 = Pelanggan::create([
            'no_hp' => '089510694912',
            'email' => 'Handoko1212@gmail.com',
            'password' => bcrypt('handokotampan'),
        ]);
        $pesanan2 = Pesan::create([
            'mobil_id' => $this->mobil->ID_Mobil,
            'user_id' => $user2->ID_Pelanggan,
            'nama_pelanggan' => 'Handoko',
            'nomor_hp' => '089510694912',
            'email' => 'Handoko1212@gmail.com',
            'tanggal_mulai' => '2025-12-09',
            'tanggal_selesai' => '2025-12-11',
            'ktp_photo_path' => 'path_ktp_dummy.jpg',
            'ktp_sim_path' => 'path_sim_dummy.jpg',
            'bukti_pembayaran_path' => 'path_bukti_pembayaran_dummy.jpg',
            'antar_jemput' => 'ambil-garasi',
        ]);
        $this->withoutExceptionHandling();
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-10',
            'tanggal_selesai' => '2025-12-12',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('pesanan.reschedule', $this->pesans->id));
        $response->assertSessionHas('error', 'Maaf untuk tanggal pilihan saat ini unit sudah tidak tersedia.');

    }
    /** @test */
    public function notChangesReschedule()
    {
        $this->withoutExceptionHandling();
        $this->pesans->reschedule_tanggal_mulai = '2025-12-10';
        $this->pesans->reschedule_tanggal_selesai = '2025-12-12';
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-10',
            'tanggal_selesai' => '2025-12-12',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('riwayat'));
    }
    /** @test */
    public function notSavingChangesReschedule()
    {
        $this->actingAs($this->user, 'pelanggan');
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-10',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('riwayat'));
        $this->assertDatabaseHas('pesans', ['total_harga' => '1500000']);
    }
    /** @test */
    public function rescheduleAtOnGoingStatus()
    {
        $this->actingAs($this->user, 'pelanggan');
        $this->pesans->status = 'on_going';
        $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-11',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('riwayat'));
    }
   /** @test */
public function rescheduleAtCanceledStatus()
{
    $this->actingAs($this->user, 'pelanggan');

    
    $this->pesans->status = 'canceled';
    $this->pesans->save();

    $response = $this->from(route('pesanan.reschedule', ['id' => $this->pesans->id]))
        ->withSession(['_token' => $this->token])
        ->put(route('pesanan.updateReschedule', ['id' => $this->pesans->id]), [
            '_token' => $this->token,
            'tanggal_mulai' => '2025-12-05',
            'tanggal_selesai' => '2025-12-10',
        ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('riwayat')); 
}

    }

