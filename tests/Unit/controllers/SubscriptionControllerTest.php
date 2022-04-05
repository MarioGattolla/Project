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

    $response = app(SubscriptionController::class)->show( $subscription);

    expect($response)->toBeView('admin.subscriptions.show', 'subscription');
});

test('subscription.index return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = app(SubscriptionController::class)->index($user);

    expect($response)->toBeView('admin.subscriptions.index');
});

test('subscription.edit return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('update', $subscription);

    $response = app(SubscriptionController::class)->edit( $subscription);

    expect($response)->toBeView('admin.subscriptions.edit', 'subscription');
});

test('subscription.create return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = app(SubscriptionController::class)->create($user);

    expect($response)->toBeView('admin.subscriptions.create');
});

test('subscriptions_search_users return response', function () {

    $request = Request::create('/subscriptions/search', 'GET', ['search' => 'test']);
    $response = app(SubscriptionController::class)->search($request);
    expect($response)->toBeInstanceOf(\Symfony\Component\HttpFoundation\Response::class);
});


