<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Pelanggan;
use Tests\TestCase;

class loginFormTest extends TestCase
{
     use RefreshDatabase;
    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Pelanggan::create([
            'no_hp' => '0812345678910',
            'email' => 'rifqi2@gmail.com',
            'password' => bcrypt('api123!'),
        ]);

        $this->token = 'testingtoken1234';
    }
    /** @test */
    public function successLogin()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => 'rifqi2@gmail.com',
            'password' => 'api123!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($this->user, 'pelanggan');
        $this->assertDatabaseHas('pelanggan', ['email' => 'rifqi2@gmail.com']);
    }
    /** @test */
    public function emptyEmail()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => '',
            'password' => 'api123!',
        ]);

        $this->assertGuest('pelanggan');
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    /** @test */
    public function emptyPassword()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => 'rifqi2@gmail.com',
            'password' => '',
        ]);

        $this->assertGuest('pelanggan');
        $response->assertSessionHasErrors(['password']);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    /** @test */
    public function wrongEmail()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => 'rifqi2gmail.com',
            'password' => 'api123!',
        ]);

        $this->assertGuest('pelanggan');
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    /** @test */
    public function wrongPassword()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => 'rifqi2@gmail.com',
            'password' => 'api1234!',
        ]);

        $this->assertGuest('pelanggan');
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function wrongEntryEmail()
    {


        $response = $this->from('/login')->withSession(['_token' => $this->token])
        ->post('/login', [
            '_token' => $this->token,
            'email' => 'fakeuser@gmail.com',
            'password' => 'api123!',
        ]);

        $this->assertGuest('pelanggan');
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
