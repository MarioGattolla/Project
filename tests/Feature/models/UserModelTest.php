<?php

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


test('setPasswordAttribute hash password attribute', function () {

    $user = new User();

    app(User::class)->setPasswordAttribute($user->password);

    expect($user->password)->not->toBe('password');
});

test('debtors_count count debtors >0', function () {

    Service::factory()->count(3)->create();

    $debtors = User::factory()->count(3)
        ->withRandomSubscriptions()
        ->create();

    $good_user = User::factory()
        ->withRandomPayments()
        ->create();

    $result = app(User::class)->debtor_count();

    expect($result)->toBe(3);
});

test('debtors_count count debtors =0', function () {

    Service::factory()->count(3)->create();

    $debtors = User::factory()->count(0)
        ->withRandomSubscriptions()
        ->create();

    $good_user = User::factory(3)
        ->withRandomPayments()
        ->create();

    $result = app(User::class)->debtor_count();

    expect($result)->toBe(0);
});
