<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pelanggan;
use App\Models\Mobil;
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Pesan;
use Illuminate\Support\Str;

class RatingUlasanTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $mobil;
    protected $kategori;
    protected $pesananSelesai;
    protected $token = 'testingtoken1234';

    protected function setUp(): void
    {
        parent::setUp();


        $this->admin = Admin::create([
        'email' => 'admin@test.com',
        'no_hp' => '0800000000',
        'password' => bcrypt('password123'),
        ]);

        $this->user = Pelanggan::create([
            'no_hp'   => '081234567899',
            'email'   => 'user@test.com',
            'password'=> bcrypt('password123'),
        ]);

        $this->kategori = Kategori::create(['Nama_Kategori' => 'SUV']);
        $this->mobil = Mobil::create([
            'Merek'            => 'Toyota',
            'Model'            => 'Avanza',
            'Tahun'            => 2020,
            'Harga_Sewa'       => 350000,
            'Kategori_ID'      => $this->kategori->id,
            'ID_Admin'         => $this->admin->ID_Admin,
            'Jumlah_Kursi'     => 7,
            'Jenis_Transmisi'  => 'manual',
        ]);

        // Pesanan SELESAI milik $this->user (boleh memberi rating)
        $this->pesananSelesai = Pesan::create([
            'mobil_id'                 => $this->mobil->ID_Mobil ?? $this->mobil->id,
            'user_id'                  => $this->user->ID_Pelanggan ?? $this->user->id,
            'nama_pelanggan'           => 'User Test',
            'nomor_hp'                 => '081234567899',
            'email'                    => 'user@test.com',
            'tanggal_mulai'            => '2025-01-01',
            'tanggal_selesai'          => '2025-01-03',
            'ktp_photo_path'           => 'ktp.jpg',
            'ktp_sim_path'             => 'sim.jpg',
            'bukti_pembayaran_path'    => 'bukti.jpg',
            'antar_jemput'             => 'ambil-garasi',
            'status'                   => 'finished', // ← sesuaikan dengan aplikasi kamu
            'total_harga'              => 700000,
        ]);
    }

    /** @test */
    public function guest_tidak_bisa_melihat_widget_rating()
    {
        // kalau di aplikasi kamu halaman index rating redirect ke login utk guest, tes begini:
        $response = $this->get(route('ulasan')); // ← ganti jika route beda
        $response->assertStatus(302)->assertRedirect(route('login')); // atau ke route lain yg kamu pakai
    }

     /** @test */
    public function user_belum_pernah_pesan_tidak_bisa_mengisi_ulasan()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user, 'pelanggan');

        $response = $this->from(route('ulasan'))
            ->withSession(['_token' => $this->token])
            ->post(route('ulasan.store'), [
                '_token'   => $this->token,
                'rating'   => 5,
                'comment'  => 'Mobil bersih dan nyaman.',
                'car_model'=> 'Avanza',
            ]);

        $response->assertStatus(302)
                 ->assertRedirect(route('ulasan'));


    }


    /** @test */
    public function user_dengan_pesanan_aktif_tidak_bisa_mengisi_ulasan()
    {
        // buat pesanan AKTIF (belum selesai)
        Pesan::create([
            'mobil_id'      => $this->mobil->ID_Mobil ?? $this->mobil->id,
            'user_id'       => $this->user->ID_Pelanggan ?? $this->user->id,
            'nama_pelanggan'=> 'User Test',
            'nomor_hp'      => '081111111111',
            'email'         => 'user@test.com',
            'tanggal_mulai' => '2025-12-10',
            'tanggal_selesai'=> '2025-12-12',
            'ktp_photo_path'=> 'ktp.jpg',
            'bukti_pembayaran_path'=> 'bukti.jpg',
            'antar_jemput'  => 'ambil-garasi',
            'status'        => 'on_going', // ↙︎ sesuaikan enum kamu
            'total_harga'   => 600000,
        ]);
         $this->withoutExceptionHandling();

        $this->actingAs($this->user, 'pelanggan');

        $response = $this->from(route('ulasan'))
            ->withSession(['_token' => $this->token])
            ->post(route('ulasan.store'), [
                '_token'   => $this->token,
                'rating'   => 4,
                'comment'  => 'Mobil bersih dan pelayanan cepat.',
                'car_model'=> 'Avanza',
            ]);

        $response->assertStatus(302)
                 ->assertRedirect(route('ulasan'))
                 ;
    }

    /** @test */
    public function user_dengan_pesanan_selesai_bisa_memberi_ulasan()
    {
        // buat pesanan SELESAI
        Pesan::create([
            'mobil_id'      => $this->mobil->ID_Mobil ?? $this->mobil->id,
            'user_id'       => $this->user->ID_Pelanggan ?? $this->user->id,
            'nama_pelanggan'=> 'User Test',
            'nomor_hp'      => '081111111111',
            'email'         => 'user@test.com',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai'=> '2025-01-03',
            'ktp_photo_path'=> 'ktp.jpg',
            'bukti_pembayaran_path'=> 'bukti.jpg',
            'antar_jemput'  => 'ambil-garasi',
            'status'        => 'finished', // atau 'completed' sesuai DB kamu
            'total_harga'   => 600000,
        ]);
        $this->withoutExceptionHandling();
        $this->actingAs($this->user, 'pelanggan');

        $response = $this->from(route('ulasan'))
            ->withSession(['_token' => $this->token])
            ->post(route('ulasan.store'), [
                '_token'   => $this->token,
                'rating'   => 5,
                'comment'  => 'Mobil bersih dan pelayanan cepat.',
                'car_model'=> 'Avanza',
            ]);

        $response->assertStatus(302)
                 ->assertRedirect(route('ulasan'))
                 ->assertSessionHas('success', 'Berhasil memberikan Rating dan ulasan.')
                 ->assertSessionHas('latest_review', [
                     'rating'   => 5,
                     'comment'  => 'Mobil bersih dan pelayanan cepat.',
                     'car_model'=> 'Avanza',
                 ]);
    }


   /** @test */
public function user_bisa_kirim_rating_dengan_input_valid()
{
    $this->withoutExceptionHandling();
    $this->actingAs($this->user, 'pelanggan');

    $response = $this->from(route('ulasan'))
        ->withSession(['_token' => $this->token])
        ->post(route('ulasan.store'), [
            '_token'   => $this->token,
            'rating'   => 5,
            'comment'  => 'Mobil bersih dan pelayanan cepat.',
            'car_model'=> 'Avanza',
        ]);

    $response->assertStatus(302)->assertRedirect(route('ulasan'));
    $response->assertSessionHas('latest_review', [
        'rating'   => 5,
        'comment'  => 'Mobil bersih dan pelayanan cepat.',
        'car_model'=> 'Avanza',
    ]);
}

/** @test */
public function ulasan_wajib_diisi()
{
    $this->withoutExceptionHandling();
    $this->actingAs($this->user, 'pelanggan');

    $response = $this->from(route('ulasan'))
        ->withSession(['_token' => $this->token])
        ->post(route('ulasan.store'), [
            '_token'   => $this->token,
            'rating'   => 4,
            'comment'  => 'bersih dan keren pelayananya',
            'car_model'=> 'Avanza',
        ]);

    $response->assertStatus(302)
             ->assertRedirect(route('ulasan'));

}

/** @test */
public function comment_500_karakter_diterima()
{
    $this->withoutExceptionHandling();
    $this->actingAs($this->user, 'pelanggan');

    $comment500 = str_repeat('a', 500);

    $response = $this->from(route('ulasan'))
        ->withSession(['_token' => $this->token])
        ->post(route('ulasan.store'), [
            '_token'   => $this->token,
            'rating'   => 5,
            'comment'  => $comment500,
            'car_model'=> 'Toyota Avanza',
        ]);

    $response->assertStatus(302)->assertRedirect(route('ulasan'));
}

/** @test */
public function comment_di_atas_500_karakter_ditolak()
{
    $this->actingAs($this->user, 'pelanggan');

    $comment501 = str_repeat('a', 501);

    $response = $this->from(route('ulasan'))
        ->withSession(['_token' => $this->token])
        ->post(route('ulasan.store'), [
            '_token'   => $this->token,
            'rating'   => 5,
            'comment'  => $comment501,
            'car_model'=> 'Toyota Avanza',
        ]);

    $response->assertStatus(302)
             ->assertRedirect(route('ulasan'))
             ->assertSessionHasErrors(['comment']);
}

/** @test */
public function rating_wajib_diisi()
{
    $this->actingAs($this->user, 'pelanggan');

    $response = $this->from(route('ulasan'))
        ->withSession(['_token' => $this->token])
        ->post(route('ulasan.store'), [
            '_token'   => $this->token,
            'rating'   => null,
            'comment'  => 'Ok',
            'car_model'=> 'Toyota Avanza',
        ]);

    $response->assertStatus(302)
             ->assertRedirect(route('ulasan'))
             ->assertSessionHasErrors(['rating']);
}

    }
