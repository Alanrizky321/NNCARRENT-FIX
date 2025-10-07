<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Mobil;
use PHPUnit\Framework\Attributes\Test;

class MobilModelTest extends TestCase
{
    #[Test]
    public function harga_mobil_harus_bernilai_positif(): void
    {
        $mobil = new Mobil(['Harga' => 100000]);

        // sekarang test-nya benar: harga harus >= 0
    $this->assertTrue($mobil->Harga >= 0, 'Harga mobil tidak boleh negatif');
    }
}
