<?php

use App\Enums\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see subscription.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/subscriptions');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/subscriptions/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/subscriptions/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/subscriptions/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


