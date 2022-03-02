<?php

use App\Http\Controllers\Admin\ServiceController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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

    expect($response)->toBeView('admin.services.edit', 'service');
});

test('service.create return view', function () {

    allow_authorize('create', Service::class);

    $response = app(ServiceController::class)->create();

    expect($response)->toBeView('admin.services.create');
});

test('service.store return redirect', function () {

    allow_authorize('create', Service::class);

    $request = Request::create('/admin/services/create', 'POST', [
        'name' => 'Piscina',
        'price' => '30'
    ]);

    $response = app(ServiceController::class)->store($request);

    expect($response)->toBeRedirect();
});

test('service.update return redirect', function () {

    /** @var Service $service */
    $service = Service::factory()->make();

    allow_authorize('update', $service);

    $request = Request::create('/admin/services/create', 'POST', [
        'name' => 'Piscina',
        'price' => '30'
    ]);

    $response = app(ServiceController::class)->update($request, $service);

    expect($response)->toBeRedirect();
});

test('service.destroy return redirect', function () {

    /** @var Service $service */
    $service = Service::factory()->make();

    allow_authorize('delete', $service);

    $response = app(ServiceController::class)->destroy($service);

    expect($response)->toBeRedirect();
});
