<?php

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


test('debtors_count count debtors', function ($debtors, $good_users, $expected_count) {
    Service::factory()->count(3)->create();


    $debtors && User::factory()->count($debtors)->withRandomSubscriptions()->create();

    $good_users && User::factory()->count($good_users)->withRandomPayments()->create();


    $result = User::debtors_count();

    expect($result)->toBe($expected_count);
})->with([
    '3 debtors' => [
        'debtors' => 3,
        'good_users' => 1,
        'expected_count' => 3
    ],
    'no debtors' => [
        'debtors' => 0,
        'good_users' => 1,
        'expected_count' => 0
    ],
]);

test('subscribed to scope', function () {
    /** @var Service $services */
    $service = Service::factory()->create();

    /** @var User $user */
    $user = User::factory()->withRandomSubscriptions()->create();

    $response = User::get_subscribed_users_by_skill($service);

    expect($response)->toBeCollection();
});
