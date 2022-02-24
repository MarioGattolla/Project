<?php

use App\Http\Controllers\Admin\ServiceController;
use App\Models\Service;



test('service.index return view', function () {


    allow_authorize('viewAny', Service::class);

    $response = app(ServiceController::class)->index();

    expect($response)->toBeView('admin.services.index');
});

test('service.edit return view', function () {

    /** @var Service $service */
    $service = Service::factory()->make();

    allow_authorize('update', $service);

    $response = app(ServiceController::class)->edit($service);

    expect($response)->toBeView('admin.services.edit');
});

test('service.create return view', function () {


    allow_authorize('create', Service::class);

    $response = app(ServiceController::class)->create();

    expect($response)->toBeView('admin.services.create');
});

