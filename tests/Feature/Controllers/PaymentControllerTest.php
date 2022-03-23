<?php

use App\Enums\Role;
use App\Http\Controllers\Admin\PaymentController;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see payment.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Payment::factory()->create();

    $response = actingAs($user)->get('/admin/users/1/payments/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see payment.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Payment::factory()->create();

    $response = actingAs($user)->get('/admin/users/1/payments/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('admin can create new payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->post('/admin/users/1/payments', [
        'user_id' => '1',
        'date' => '2020-10-10',
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index', $user));
});

test('admin can edit payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    $response = $this->actingAs($user)->put(route('payments.update', [$user, $payment]), [
        'date' => '2020-10-10',
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.show',[$user, $payment]));
});

test('admin can delete payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    $response = $this->actingAs($user)->delete(route('payments.destroy', [$user, $payment]));

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index', $user));
});

test('payment.store return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    $request = Request::create('/admin/users/{user}/payments/create', 'POST', [
        'user_id' => $user->id,
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->store( $request, $user);

    expect($response)->toBeRedirect(route('payments.index', $user) );
});

test('payment.update return redirect', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    /** @var User $user */
    $user = User::factory()->create();

    allow_authorize('update', $payment);

    $request = Request::create('/admin/users/{user}/payments/{payment}/edit', 'POST', [
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->update($request, $user, $payment);

    expect($response)->toBeRedirect(route('payments.show', [$user, $payment]));
});

test('payment.destroy return redirect', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    /** @var User $user */
    $user = User::factory()->create();

    allow_authorize('delete', $payment);

    $response = app(PaymentController::class)->destroy($user, $payment);

    expect($response)->toBeRedirect(route('payments.index', $user));
});




