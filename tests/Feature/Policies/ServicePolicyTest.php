<?php /** @noinspection PhpParamsInspection */

use App\Enums\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

uses(RefreshDatabase::class);

test('viewAny cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('viewAny', Service::class);

    assertTrue($response);
});

test('viewAny cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('viewAny', Service::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});



test('create cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('create', Service::class);

    assertTrue($response);
});

test('create cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('create', Service::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('update cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    $service = Service::factory()->make();

    actingAs($user);

    $response = Gate::check('update', $service);

    assertTrue($response);
});

test('update cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    $service = Service::factory()->make();

    actingAs($user);

    $response = Gate::check('update', $service);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('delete cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    $service = Service::factory()->make();

    actingAs($user);

    $response = Gate::check('delete', $service);

    assertTrue($response);
});

test('delete cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    $service = Service::factory()->make();

    actingAs($user);

    $response = Gate::check('delete', $service);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

