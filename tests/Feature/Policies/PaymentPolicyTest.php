<?php /** @noinspection PhpParamsInspection */

use App\Enums\Role;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

uses(RefreshDatabase::class);

test('viewAny cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('viewAny', Payment::class);

    assertTrue($response);
});

test('viewAny cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('viewAny', Payment::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('view cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('view', $payment);

    assertTrue($response);
});

test('view cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('view', $payment);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('create cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    actingAs($user);

    $response = Gate::check('create', Payment::class);

    assertTrue($response);
});

test('create cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    actingAs($user);

    $response = Gate::check('create', Payment::class);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('update cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('update', $payment);

    assertTrue($response);
});

test('update cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('update', $payment);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('delete cecked on Admin', function () {

    $user = User::factory()->role(Role::admin)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('delete', $payment);

    assertTrue($response);
});

test('delete cecked on Roles', function (Role $role) {

    $user = User::factory()->role($role)->make();

    $payment = Payment::factory()->make();

    actingAs($user);

    $response = Gate::check('delete', $payment);

    assertFalse($response);

})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

