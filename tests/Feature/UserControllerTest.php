<?php

use App\Enums\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see user.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/users');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see user.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/users/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see user.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/users/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see user.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/users/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see user.beacoach page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/users/1/beacoach');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('admin can create new user', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->post('/admin/users', [
        'name' => 'Test',
        'surname' => 'Test',
        'password' => 'password',
        'email' => 'test@gmail.com',
        'role' => 'User',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect('/admin/users');
});

test('admin can edit user', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->put(route('users.update', $user), [
        'name' => 'Test',
        'surname' => 'Test',
        'password' => 'password',
        'email' => 'test@gmail.com',
        'role' => 'User',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('users.show', $user));
});

test('admin can delete user', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->delete(route('users.destroy', $user));

    expect($response)->toHaveStatus(302)->assertRedirect(route('users.index'));
});

test('admin can set user role to coach', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->put(route('beacoach.update', $user), [
        'services' => Service::factory()->create()->id,
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('users.show', $user));
});



