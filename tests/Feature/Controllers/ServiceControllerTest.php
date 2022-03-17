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


test('admin can create new service', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    $response = $this->actingAs($user)->post('/admin/services', [
        'name' => 'test',
        'price' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect('/admin/services');
});

test('admin can edit service', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    /** @var Service $service */
    $service = Service::factory()->create();

    $response = $this->actingAs($user)->put(route('services.update', $service), [
        'name' => 'test',
        'price' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('services.index'));
});

test('admin can delete service', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    /** @var Service $service */
    $service = Service::factory()->create();

    $response = $this->actingAs($user)->delete(route('services.destroy', $service));

    expect($response)->toHaveStatus(302)->assertRedirect(route('services.index'));
});


