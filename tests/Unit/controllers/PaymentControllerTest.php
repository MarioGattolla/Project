<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('payment.show return view', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('view', $payment);

    $response = app(PaymentController::class)->show($user, $payment);

    expect($response)->toBeView('admin.payments.show');
});

test('payment.index return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('viewAny', Payment::class);

    $response = app(PaymentController::class)->index($user);

    expect($response)->toBeView('admin.payments.index');
});

test('payments.edit return view', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('update', $payment);

    $response = app(PaymentController::class)->edit($user , $payment);

    expect($response)->toBeView('admin.payments.edit');
});

test('payment.create return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('create', Payment::class);

    $response = app(PaymentController::class)->create($user);

    expect($response)->toBeView('admin.payments.create');
});



