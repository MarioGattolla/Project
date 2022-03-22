<?php

use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

uses(RefreshDatabase::class);

test('subscription.show return view', closure: function () {

    /** @var User $user */
    $user = User::factory()->make();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('view', $subscription);

    $response = app(SubscriptionController::class)->show($user, $subscription);

    expect($response)->toBeView('admin.subscriptions.show', 'subscription');
});

test('subscription.index return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('viewAny', Subscription::class);

    $response = app(SubscriptionController::class)->index($user);

    expect($response)->toBeView('admin.subscriptions.index');
});

test('subscription.edit return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('update', $subscription);

    $response = app(SubscriptionController::class)->edit($user, $subscription);

    expect($response)->toBeView('admin.subscriptions.edit', 'subscription');
});

test('subscription.create return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('create', Subscription::class);

    $response = app(SubscriptionController::class)->create($user);

    expect($response)->toBeView('admin.subscriptions.create');
});


