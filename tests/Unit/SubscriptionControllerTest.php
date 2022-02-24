<?php

use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Subscription;

test('subscription.show return view', function () {

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('view', $subscription);

    $response = app(SubscriptionController::class)->show($subscription);

    expect($response)->toBeView('admin.subscriptions.show');
});

test('subscription.index return view', function () {


    allow_authorize('viewAny', Subscription::class);

    $response = app(SubscriptionController::class)->index();

    expect($response)->toBeView('admin.subscriptions.index');
});

test('subscription.edit return view', function () {

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('update', $subscription);

    $response = app(SubscriptionController::class)->edit($subscription);

    expect($response)->toBeView('admin.subscriptions.edit');
});

test('subscription.create return view', function () {


    allow_authorize('create', Subscription::class);

    $response = app(SubscriptionController::class)->create();

    expect($response)->toBeView('admin.subscriptions.create');
});


