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
     /** @test */
    public function validDataEntry()
    {
        $this->actingAs($this->admin, 'admin');
        Storage::fake('public');
        $file = UploadedFile::fake()->create('mobil.jpg', 100);
        $response = $this->from(route('mobil.create'))->withSession(['_token' => $this->token])
        ->post(route('mobil.store'), [
            '_token' => $this->token,
            'Merek' => 'Toyota',
            'Model' => 'Avanza',
            'Tahun' => 2025,
            'Harga_Sewa' => 350000,
            'Kategori_ID' => $this->kategori->id,
            'ID_Admin' => $this->admin->ID_Admin,
            'Jumlah_Kursi' => 7,
            'Jenis_Transmisi' => 'manual',
            'foto' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('mobil.create'));
    }
     /** @test */
    public function merekOverCharacter()
    {
        $this->actingAs($this->admin, 'admin');
        Storage::fake('public');
        $file = UploadedFile::fake()->create('mobil.jpg', 100);
        $response = $this->from(route('mobil.create'))->withSession(['_token' => $this->token])
        ->post(route('mobil.store'), [
            '_token' => $this->token,
            'Merek' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam eget eros sit amet laoreet. Sed lorem lacus, condimentum et convallis vel, consectetur vel neque. Curabitur ullamcorper, nisl sollicitudin mattis auctor, eros risus molestie felis, eget gravida lectus sem et mi. Nullam hendrerit convallis mollis. Donec tempus convallis nulla vel cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare libero nulla, in placerat ante finibus at. Fusce tortor nunc, vulputate sed sodales id, malesuada maximus metus. Aenean blandit ex a semper vehicula. Sed condimentum dui orci, in consequat ante finibus sit amet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque nec tortor sed quam vulputate imperdiet. Vestibulum erat magna, ullamcorper vitae ipsum ut, tempor porttitor risus.
Suspendisse pretium venenatis velit, ac ornare nibh placerat ut. Aliquam non feugiat tellus. Mauris egestas ullamcorper urna, vel blandit mauris congue in. Suspendisse pellentesque cursus porta. Nam in mollis erat. In tincidunt tincidunt suscipit. Nam mollis sodales ultrices. Praesent sodales luctus purus quis scelerisque. Nunc vitae posuere mi. In mollis et nulla non ornare. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec ligula blandit, consequat est quis, dictum lectus. Proin commodo consequat arcu, quis dapibus erat suscipit in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;
Donec iaculis commodo justo sit amet iaculis. Vestibulum condimentum vehicula enim, at maximus elit. Maecenas ac tellus ut magna congue aliquet. Nunc et molestie ex. Nam posuere bibendum neque, in placerat diam porttitor ac asdasd.',
            'Model' => 'Avanza',
            'Tahun' => 2025,
            'Harga_Sewa' => 350000,
            'Kategori_ID' => $this->kategori->id,
            'ID_Admin' => $this->admin->ID_Admin,
            'Jumlah_Kursi' => 7,
            'Jenis_Transmisi' => 'manual',
            'foto' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('mobil.create'));
        $response->assertSessionHasErrors(['Merek']);
    }
     /** @test */
    public function nonNumericAtTahun()
    {
        $this->actingAs($this->admin, 'admin');
        Storage::fake('public');
        $file = UploadedFile::fake()->create('mobil.jpg', 100);
        $response = $this->from(route('mobil.create'))->withSession(['_token' => $this->token])
        ->post(route('mobil.store'), [
            '_token' => $this->token,
            'Merek' => 'Toyota',
            'Model' => 'Avanza',
            'Tahun' => "Dua ribu empat",
            'Harga_Sewa' => 350000,
            'Kategori_ID' => $this->kategori->id,
            'ID_Admin' => $this->admin->ID_Admin,
            'Jumlah_Kursi' => 7,
            'Jenis_Transmisi' => 'manual',
            'foto' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('mobil.create'));
        $response->assertSessionHasErrors(['Tahun']);
    }
}
