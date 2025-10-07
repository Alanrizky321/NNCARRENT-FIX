<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mobil;
use App\Models\Admin;
use App\Models\Kategori;

class MobilFactory extends Factory
{
    protected $model = Mobil::class;

    public function definition(): array
    {
        return [
            'Merek' => $this->faker->company(),
            'Model' => $this->faker->word(),
            'Tahun' => $this->faker->year(),
            'Harga_Sewa' => $this->faker->numberBetween(100000, 500000), // Lebih realistis
            'Foto' => 'default.jpg',
            'Status_Ketersediaan' => $this->faker->boolean(), // 0 atau 1
            'Kategori_ID' => Kategori::factory(), // Buat Kategori otomatis
            'ID_Admin' => Admin::factory(), // Buat Admin otomatis
            'Jumlah_Kursi' => $this->faker->numberBetween(4, 7),
            'Jenis_Transmisi' => $this->faker->randomElement(['Automatic', 'Manual']),
        ];
    }
}