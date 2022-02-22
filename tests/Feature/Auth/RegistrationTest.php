<?php

use App\Providers\RouteServiceProvider;
use App\Enums\Role;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

test('registration sceeen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});


test("new_users_can_register", function () {
    $response = $this->post('/register', [
        'name' => 'Test Name',
        'surname' => 'Test Surname',
        'role' => 'User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('verification email is sent', function(){
    Notification::fake();

    $this->post('/register', [
        'name' => 'Test Name',
        'surname' => 'Test Surname',
        'role' => 'Admin',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    Notification::assertSentTo(Auth::user(), VerifyEmail::class);
});
