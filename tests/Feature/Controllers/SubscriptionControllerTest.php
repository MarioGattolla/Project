<?php

use App\Enums\Role;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see subscription.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/users/1/subscriptions');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/users/1/subscriptions/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/users/1/subscriptions/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/users/1/subscriptions/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('admin can create new subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->post('/admin/users/1/subscriptions', [
        'user_id' => $user->id,
        'services' => [1,2],
        'start' => '2020-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect();
});

test('admin can edit subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Subscription $subscriptions */
    $subscriptions = Subscription::factory()->create();

    $response = $this->actingAs($user)->put(route('subscriptions.update',[$user,  $subscriptions]), [
        'services' => Service::factory()->create()->id,
        'start' => '2022-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.show',[$user, $subscriptions]));
});

test('admin can delete subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Subscription $subscriptions */
    $subscriptions = Subscription::factory()->create();

    $response = $this->actingAs($user)->delete(route('subscriptions.destroy', [$user,$subscriptions]));

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.index', $user));
});


test('subscription.store return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var Service $services */
    $services = Service::factory()->count(3)->create();

    allow_authorize('create', Subscription::class);

    $request = Request::create('/admin/users/1/subscriptions/create', 'POST', [
        'user_id' => $user->id,
        'services' => [1, 2],
        'start' => '2022-03-01',
        'end' => '2023-01-24',

    ]);

    $response = app(SubscriptionController::class)->store($request, $user);

    expect($response)->toBeRedirect(route('subscriptions.index', $user));
});

test('subscription.update return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->create();

    allow_authorize('update', $subscription);

    $request = Request::create('/admin/users/1/subscriptions/{subscription}/edit', 'POST', [
        'services' => Service::factory()->create()->id,
        'start' => '2022-03-01',
        'end' => '2023-01-24',
    ]);

    $response = app(SubscriptionController::class)->update($request, $user, $subscription);

    expect($response)->toBeRedirect(route('subscriptions.show', [$user, $subscription]));
});

test('subscription.destroy return redirect', function () {

    /** @var User $user */
    $user = User::factory()->create();

    /** @var Subscription $subscription */
    $subscription = Subscription::factory()->make();

    allow_authorize('delete',  $subscription);

    $response = app(SubscriptionController::class)->destroy($user, $subscription);

    expect($response)->toBeRedirect(route('subscriptions.index', $user));
});
