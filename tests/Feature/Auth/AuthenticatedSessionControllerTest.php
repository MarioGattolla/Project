<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;

uses(RefreshDatabase::class);

test('ceck destroy session function', function () {

    $user = new User();

    actingAs($user)->post('/logout');

    assertGuest();
});
