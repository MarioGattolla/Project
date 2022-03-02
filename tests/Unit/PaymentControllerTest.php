<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('payment.show return view', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    allow_authorize('view', $payment);

    $response = app(PaymentController::class)->show($payment);

    expect($response)->toBeView('admin.payments.show', 'payment');
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

    $response = app(PaymentController::class)->edit($payment, 'payment');

    expect($response)->toBeView('admin.payments.edit');
});

test('payment.create return view', function () {


    allow_authorize('create', Payment::class);

    $response = app(PaymentController::class)->create();

    expect($response)->toBeView('admin.payments.create');
});

test('payment.store return redirect', function () {

    allow_authorize('create', Payment::class);

    $request = Request::create('/admin/payments/create', 'POST', [
        'user_id' => \App\Models\User::factory()->create()->id,
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->store($request);

    expect($response)->toBeRedirect();
});

test('payment.update return redirect', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    allow_authorize('update', $payment);

    $request = Request::create('/admin/payments/{payment}/edit', 'POST', [
        'quote' => '22',
        'date' => '2020-10-21',
    ]);

    $response = app(PaymentController::class)->update($request, $payment);

    expect($response)->toBeRedirect();
});

test('payment.destroy return redirect', function () {

    /** @var Payment $payment */
    $payment = Payment::factory()->make();

    allow_authorize('delete', $payment);

    $response = app(PaymentController::class)->destroy( $payment);

    expect($response)->toBeRedirect();
});



