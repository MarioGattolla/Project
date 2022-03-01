<?php

use App\Enums\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see service.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/services');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see service.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/services/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('cant see service.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Service::factory()->create();

    $response = actingAs($user)->get('/admin/services/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


