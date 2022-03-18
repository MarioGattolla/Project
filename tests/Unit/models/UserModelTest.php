<?php

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('show_user_subscribed_services return collection', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = $user->subscribed_services();

    expect($response)->toBeCollection();
});

test('how_users_coached_list_for_skill return collection', function () {
    /** @var Service $skill */
    $skill = Service::factory()->make();
    $response = User::get_subscribed_users_by_skill($skill);

    expect($response)->toBeCollection();
});

test('balance return value', function () {

    /** @var User $user */
    $user = User::factory()->make();

    $response = $user->balance();

    expect($response)->toBeFloat();
});

test('setting password encrypt it', function () {

    $user = new User();

    $user->password = '123456';

    expect(Hash::check('123456', $user->password))->toBeTrue();

});

test('debtors_count return int value', function () {

    $response = User::debtors_count();

    expect($response)->toBeInt();
});
