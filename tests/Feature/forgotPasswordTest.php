<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Pelanggan;
use Tests\TestCase;

class forgotPasswordTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Pelanggan::create([
            'no_hp' => '0812345678910',
            'email' => 'user1234@gmail.com',
            'password' => bcrypt('api123!'),
        ]);

        $this->token = 'testingtoken1234';
    }
    /** @test */
    public function wrongEmail()
    {


        $response = $this->from(route('password.request'))->withSession(['_token' => $this->token])
        ->post(route('password.email'), [
            '_token' => $this->token,
            'email' => 'munyenyo19@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('password.request'));
        $response->assertSessionHasErrors([
            'email' => 'Email tidak ditemukan.'
        ]);
        $response->assertSessionHasErrors('email');
    }
    /** @test */
    public function validEmail()
    {
        $response = $this->from(route('password.request'))->withSession(['_token' => $this->token])
        ->post(route('password.email'), [
            '_token' => $this->token,
            'email' => 'user1234@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('password.request'));
        $response->assertSessionDoesntHaveErrors('email');
    }
    /** @test */
    public function invalidEmailPassword()
    {
        $response = $this->from(route('password.request'))->withSession(['_token' => $this->token])
        ->post(route('password.email'), [
            '_token' => $this->token,
            'email' => 'user1234gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('password.request'));
        $response->assertSessionHasErrors('email');
    }
    /** @test */
    public function emailNotRegister()
    {
        $response = $this->from(route('password.request'))->withSession(['_token' => $this->token])
        ->post(route('password.email'), [
            '_token' => $this->token,
            'email' => 'user1234@cihuy.co.id',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('password.request'));
        $response->assertSessionHasErrors('email');
    }
}
