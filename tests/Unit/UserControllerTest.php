<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

uses(RefreshDatabase::class);

test('user.show return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('view', $user);

    $response = app(UserController::class)->show($user);

    expect($response)->toBeView('admin.users.show');
});

test('user.index return view', function () {


    allow_authorize('viewAny', User::class);

    $response = app(UserController::class)->index();

    expect($response)->toBeView('admin.users.index');
});

test('user.edit return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('update', $user);

    $response = app(UserController::class)->edit($user);

    expect($response)->toBeView('admin.users.edit');
});

test('user.create return view', function () {


    allow_authorize('create', User::class);

    $response = app(UserController::class)->create();

    expect($response)->toBeView('admin.users.create');
});

test('user.beacoach return view', function () {

    /** @var User $user */
    $user = User::factory()->make();

    allow_authorize('beacoach', $user);

    $response = app(UserController::class)->beacoach($user);

    expect($response)->toBeView('admin.users.beacoach');
});


test('user store return redirect', function () {


    allow_authorize('create', User::class);

    $request = Request::create('/admin/users/create', 'POST',[
        'name' => 'Mario',
        'surname' => 'Gattolla',
        'email' => 'email@libero.it',
        'role' => 'User',
        'password' => ' password',
    ]);

    $response = app(UserController::class)->store($request);

    expect($response)->toBeRedirect();
});

