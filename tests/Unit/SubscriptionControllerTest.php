<?php

use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

uses(RefreshDatabase::class);

test('subscription.show return view', function () {

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('view', $subscription);

    $response = app(SubscriptionController::class)->show($subscription);

    expect($response)->toBeView('admin.subscriptions.show', 'subscription');
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

    expect($response)->toBeView('admin.subscriptions.edit', 'subscription');
});

test('subscription.create return view', function () {


    allow_authorize('create', Subscription::class);

    $response = app(SubscriptionController::class)->create();

    expect($response)->toBeView('admin.subscriptions.create');
});

test('subscription.store return redirect', function () {

    allow_authorize('create', Subscription::class);

    $request = Request::create('/admin/subscriptions/create', 'POST', [
        'user_id' => \App\Models\User::factory()->create()->id,
        'services' => \App\Models\Service::factory()->create()->id,
        'start' => '2022-03-01',
        'end' => '2023-01-24',
    ]);

    $response = app(SubscriptionController::class)->store($request);

    expect($response)->toBeRedirect();
});

test('subscription.update return redirect', function () {

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('update', $subscription);

    $request = Request::create('/admin/subscriptions/{subscription}/edit', 'POST', [
        'services' => \App\Models\Service::factory()->create()->id,
        'start' => '2022-03-01',
        'end' => '2023-01-24',
    ]);

    $response = app(SubscriptionController::class)->update($request, $subscription);

    expect($response)->toBeRedirect();
});

test('subscription.destroy return redirect', function () {

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('delete', $subscription);

    $response = app(SubscriptionController::class)->destroy($subscription);

    expect($response)->toBeRedirect();
});
