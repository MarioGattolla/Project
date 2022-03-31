<?php /** @noinspection PhpUnhandledExceptionInspection */

/** @noinspection PhpParamsInspection */

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

    $response = actingAs($user)->get('/payments/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see payment.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Payment::factory()->create();

    $response = actingAs($user)->get('/payments/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test(' can create new payment', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = $this->actingAs($user)->post('/payments', [
        'date' => today(),
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index'));
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test(' admin can create new payment', function () {

    /** @var User $user */
    $admin = User::factory()->role(Role::admin)->create();
    $user = User::factory()->role(Role::user)->create();

    $response = $this->actingAs($admin)->post('/payments', [
        'id' => $user->id,
        'date' => today(),
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index'));
});


test('admin can edit payment', function () {

    /** @var User $admin */
    $admin = User::factory()->role(Role::admin)->create();

    /** @var User $user */
    $user = User::factory()->role(Role::user)->create();

    /** @var Payment $payment */
    $payment = Payment::factory()->forUser($user)->create();


    $response = $this->actingAs($admin)->put(route('payments.update', $payment), [
        'date' => today(),
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.show', $payment));
});

test('admin can delete payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    $response = $this->actingAs($user)->delete(route('payments.destroy',  $payment));

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index'));
});

test('payment.store return redirect', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    actingAs($user);
    $request = \Illuminate\Http\Request::create('/payments/create', 'POST', [

        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->store($request);

    expect($response)->toBeRedirect(route('payments.index') );
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('payment.store return redirect with Admin', closure: function () {

    /** @var User $user */
    $admin = User::factory()->role(Role::admin)->create();
    $user = User::factory()->role(Role::user)->create();

    actingAs($admin);

    $request = \Illuminate\Http\Request::create('/payments/create', 'POST', [
        'id' => $user->id,
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->store($request);

    expect($response)->toBeRedirect(route('payments.index') );
});

test('payment.update return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var Payment $payment */
    $payment = Payment::factory()->forUser($user)->create();

    allow_authorize('update', $payment);

    $request = \Illuminate\Http\Request::create('/payments/{payment}/edit', 'POST', [
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->update($request,  $payment);

    expect($response)->toBeRedirect(route('payments.show',  $payment));
});

test('payment.destroy return redirect', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    /** @var User $user */
    User::factory()->create();

    allow_authorize('delete', $payment);

    $response = app(PaymentController::class)->destroy($payment);

    expect($response)->toBeRedirect(route('payments.index'));
});




