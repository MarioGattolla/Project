<?php

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('show_user_subscribed_services return collection', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = $user->show_user_subscribed_services();

    expect($response)->toBeCollection();
});

test('how_users_coached_list_for_skill return collection', function () {

    /** @var User $user */
    $user = User::factory()->make();

    /** @var Service $skill */
    $skill = Service::factory()->make();
    $response = $user->show_users_coached_list_for_skill($skill);

    expect($response)->toBeCollection();
});

test('balance return value', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = $user->balance($user);

    expect($response)->toBeFloat();
});

test('setPasswordAttribute return void ', function () {

    $user = new User();

    $response = $user->setPasswordAttribute($user->password);

    expect($response)->toBeNull();

});
