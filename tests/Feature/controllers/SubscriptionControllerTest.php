<?php

use App\Enums\Role;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('cant see subscription.index page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/subscriptions');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.create page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    $response = actingAs($user)->get('/admin/subscriptions/create');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.show page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/subscriptions/1');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

test('cant see subscription.edit page', function ($role) {

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    Subscription::factory()->create();

    $response = actingAs($user)->get('/admin/subscriptions/1/edit');

    $response->assertStatus(403);
})->with(function () {
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});


test('admin can create new subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    $response = $this->actingAs($user)->post('/admin/subscriptions', [
        'user_id' => User::factory()->create()->id,
        'services' => Service::factory()->create()->id,
        'start' => '2020-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect('/admin/subscriptions');
});

test('admin can edit subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Subscription $subscriptions */
    $subscriptions = Subscription::factory()->create();

    $response = $this->actingAs($user)->put(route('subscriptions.update', $subscriptions), [
        'services' => Service::factory()->create()->id,
        'start' => '2022-10-10',
        'end' => '2022-11-10',
    ]);

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.show', $subscriptions));
});

test('admin can delete subscription', function () {

    /** @var User $user */
    $user = User::factory()->role(Role::admin)->create();

    /** @var Subscription $subscriptions */
    $subscriptions = Subscription::factory()->create();

    $response = $this->actingAs($user)->delete(route('subscriptions.destroy', $subscriptions));

    expect($response)->toHaveStatus(302)->assertRedirect(route('subscriptions.index'));
});




