<?php

use App\Enums\Role;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see subscription.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/subscriptions/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/subscriptions/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test(' can create new subscription', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = $this->actingAs($user)->post('/subscriptions', [
        'user_id' => $user->id,
        'services' => [1, 2],
        'start' => '2020-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect();
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value);
});

test('admin can edit subscription', function () {

    /** @var Service $service */
    $service = Service::factory()->count(3)->create();

    /** @var User $user */
    $user = User::factory()->role(Role::user)->withRandomSubscriptions()->create();

    /** @var User $admin */
    $admin = User::factory()->role(Role::admin)->withRandomSubscriptions()->create();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->forUser($user)->create();

    $response = $this->actingAs($admin)->put(route('subscriptions.update', $subscription), [
        'services' => [1, 2],
        'start' => '2022-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.show', $subscription));
});

test('admin can delete subscription', function () {

    /** @var Service $service */
    $service = Service::factory()->count(3)->create();

    /** @var User $user */
    $user = User::factory()->role(Role::user)->withRandomSubscriptions()->create();

    /** @var User $admin */
    $admin = User::factory()->role(Role::admin)->withRandomSubscriptions()->create();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->forUser($user)->create();

    $response = $this->actingAs($admin)->delete(route('subscriptions.destroy', $subscription));

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.index'));
});


test('subscription.store return redirect',  function () {

    /** @var Service $service */
    $service = Service::factory()->count(3)->create();

    /** @var User $user */
    $user = User::factory()->role(Role::user)->create();

    actingAs($user);

    $request = \Illuminate\Http\Request::create('/subscriptions/create', 'POST', [
        'services' => [1, 2],
        'start' => '2022-03-01',
        'end' => '2023-01-24',
    ]);

    $response = app(SubscriptionController::class)->store($request);

    expect($response)->toBeRedirect(route('subscriptions.index'));
})->only();

test('subscription.update return redirect', function () {

    /** @var Service $service */
    $service = Service::factory()->count(3)->create();

    /** @var User $user */
    $user = User::factory()->role(Role::user)->withRandomSubscriptions()->create();


    /** @var Subscription $subscriptions */
    $subscription = Subscription::factory()->count(2)->forUser($user)->create();


    allow_authorize('update', $subscription);

    $request = \Illuminate\Http\Request::create('/subscriptions/{subscription}/edit', 'POST', [
        'services' => [1, 2],
        'start' => '2022-03-01',
        'end' => '2023-01-24',
    ]);


    $response = app(SubscriptionController::class)->update($request, $subscription);

    expect($response)->toBeRedirect(route('subscriptions.show', $subscription));
});

test('subscription.destroy return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('delete', $subscription);

    $response = app(SubscriptionController::class)->destroy($subscription);

    expect($response)->toBeRedirect(route('subscriptions.index'));
});
