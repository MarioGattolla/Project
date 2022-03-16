<?php

use App\Enums\Role;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see payment.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/payments');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see payment.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/payments/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see payment.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Payment::factory()->create();

    $response = actingAs($user)->get('/admin/payments/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see payment.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Payment::factory()->create();

    $response = actingAs($user)->get('/admin/payments/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('admin can create new payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    $response = $this->actingAs($user)->post('/admin/payments', [
        'user_id' => '1',
        'date' => '2020-10-10',
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index'));
});

test('admin can edit payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    $response = $this->actingAs($user)->put(route('payments.update', $payment), [
        'date' => '2020-10-10',
        'quote' => '30',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.show', $payment));
});

test('admin can delete payment', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->make();

    /** @var Payment $payment */
    $payment = Payment::factory()->create();

    $response = $this->actingAs($user)->delete(route('payments.destroy', $payment));

    expect($response)->toHaveStatus(302)->assertRedirect(route('payments.index'));
});



