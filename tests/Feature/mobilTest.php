<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Pesan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Admin;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class mobilTest extends TestCase
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

        $this->token = 'testingtoken1234';
    }
     /** @test */
    public function emptyMerekData()
    {
        $this->actingAs($this->admin, 'admin');
        Storage::fake('public');
        $file = UploadedFile::fake()->create('mobil.jpg', 100);
        $response = $this->from(route('mobil.create'))->withSession(['_token' => $this->token])
        ->post(route('mobil.store'), [
            '_token' => $this->token,
            'Merek' => '',
            'Model' => 'Alya',
            'Tahun' => 2004,
            'Harga_Sewa' => 300000,
            'Kategori_ID' => $this->kategori->id,
            'ID_Admin' => $this->admin->ID_Admin,
            'Jumlah_Kursi' => 4,
            'Jenis_Transmisi' => 'manual',
            'tanggal_selesai' => '2025-12-07',
            'foto' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('mobil.create'));
    }
}
