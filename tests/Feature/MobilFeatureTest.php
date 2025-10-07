<?php
namespace Tests\Feature;

use App\Models\Mobil;
use App\Models\Kategori;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MobilFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_user_can_view_list_of_mobil()
    {
        $kategori = Kategori::factory()->create();
        $admin = Admin::factory()->create();
        Mobil::factory()->count(3)->create([
            'Kategori_ID' => $kategori->id,
            'ID_Admin' => $admin->ID_Admin,
        ]);

        $res = $this->get(route('mobil.index'));
        $res->assertStatus(200);
        $res->assertSee('Daftar Mobil'); // Pastikan teks ini ada di daftarmobiladmin.blade.php
        $this->assertDatabaseCount('mobil', 3);
    }

    #[Test]
    public function test_admin_can_add_new_mobil()
    {
        $kategori = Kategori::factory()->create();
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin'); // Ubah ke 'admin' karena redirect ke daftarmobiladmin

        $payload = [
            'Merek' => 'Toyota',
            'Model' => 'Avanza',
            'Tahun' => 2022,
            'Harga_Sewa' => 250000,
            'Foto' => 'default.jpg',
            'Status_Ketersediaan' => 1,
            'Jumlah_Kursi' => 7,
            'Jenis_Transmisi' => 'manual', // Ubah ke huruf kecil
            'Kategori_ID' => $kategori->id,
            'ID_Admin' => $admin->ID_Admin,
        ];

        $res = $this->post(route('mobil.store'), $payload);
        $res->assertStatus(302);
        $res->assertRedirect(route('daftarmobiladmin')); // Ubah ke daftarmobiladmin
        $this->assertDatabaseHas('mobil', ['Merek' => 'Toyota']);
    }
    #[Test]
    public function test_user_can_view_mobil_detail()
{
    $kategori = Kategori::factory()->create();
    $admin = Admin::factory()->create();
    $mobil = Mobil::factory()->create([
        'Kategori_ID' => $kategori->id,
        'ID_Admin' => $admin->ID_Admin,
    ]);

    $res = $this->get(route('mobil.index', $mobil->id));
    $res->assertStatus(200);
    $res->assertSee($mobil->Merek); // Pastikan teks Merek ada di view detail
}
    #[Test]
    public function test_admin_cannot_add_mobil_without_merek()
{
    $kategori = Kategori::factory()->create();
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin');

    $payload = [
        'Merek' => '', // Kosong
        'Model' => 'Avanza',
        'Tahun' => 2022,
        'Harga_Sewa' => 250000,
        'Foto' => 'default.jpg',
        'Status_Ketersediaan' => 1,
        'Jumlah_Kursi' => 7,
        'Jenis_Transmisi' => 'manual',
        'Kategori_ID' => $kategori->id,
        'ID_Admin' => $admin->ID_Admin,
    ];

    $res = $this->post(route('mobil.store'), $payload);
    $res->assertStatus(302);
    $res->assertSessionHasErrors('Merek');
    $this->assertDatabaseCount('mobil', 0);
}
}
