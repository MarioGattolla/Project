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
