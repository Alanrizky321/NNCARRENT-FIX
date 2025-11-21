<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function successRegister()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('pelanggan', ['email' => 'test@example.com']);

    }
     /** @test */
    public function emptyEmailRegister()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => '',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email']);
    }
     /** @test */
    public function emptyNoHpRegister()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['no_hp']);
    }
     /** @test */
    public function notUseValidEmail()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'testexample.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['email']);
    }
     /** @test */
    public function noHpWithAlphabet()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => ' 081221113abc',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['no_hp']);
    }
     /** @test */
    public function noHpTooShort()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => ' 8123',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc12345!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['no_hp']);
    }
     /** @test */
    public function emptyPassword()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
    }
     /** @test */
    public function passwordTooShort()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'test@example.com',
            'password' => 'abc12',
            'password_confirmation' => 'abc12',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['password']);
    }
     /** @test */
    public function passwordConfirmationEmpty()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
    }
     /** @test */
    public function notMatchConfirmationPassword()
    {
        $this->withoutMiddleware();
        $response = $this->from('/register')->post('/register', [
            'no_hp' => '0812345678910',
            'email' => 'test@example.com',
            'password' => 'Abc12345!',
            'password_confirmation' => 'Abc54321!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/register');
    }
}
