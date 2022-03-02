<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

uses(RefreshDatabase::class);

test('viewAny cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('viewAny', User::class);

    assertTrue($response);
});

test('viewAny cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('viewAny', User::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('view cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('view', $user);

    assertTrue($response);
});

test('view cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('view', $user);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('create cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('create', User::class);

    assertTrue($response);
});

test('create cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('create', User::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('update cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('update', $user);

    assertTrue($response);
});

test('update cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('update', $user);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('delete cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('delete', $user);

    assertTrue($response);
});

test('delete cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('delete', $user);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('beacoach cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('beacoach', $user);

    assertTrue($response);
});

test('beacoach cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('beacoach', $user);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});
