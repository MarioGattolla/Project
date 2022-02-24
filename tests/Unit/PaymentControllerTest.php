<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Models\Payment;

test('payment.show return view', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    allow_authorize('view', $payment);

    $response = app(PaymentController::class)->show($payment);

    expect($response)->toBeView('admin.payments.show');
});

test('payment.index return view', function () {


    allow_authorize('viewAny', Payment::class);

    $response = app(PaymentController::class)->index();

    expect($response)->toBeView('admin.payments.index');
});

test('payments.edit return view', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    allow_authorize('update', $payment);

    $response = app(PaymentController::class)->edit($payment);

    expect($response)->toBeView('admin.payments.edit');
});

test('payment.create return view', function () {


    allow_authorize('create', Payment::class);

    $response = app(PaymentController::class)->create();

    expect($response)->toBeView('admin.payments.create');
});


