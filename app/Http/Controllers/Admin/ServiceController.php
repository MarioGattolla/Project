<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/** @var Service[] $services */

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller

{
    public function create(): View
    {
        $this->authorize('create', Service::class);

        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Service::class);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Service successfully created !!');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Service::class);

        $services = Service::all();
        return view('admin.services.index', [
            'services' => $services
        ]);
    }

    public function edit(Service $service): View
    {
        $this->authorize('update', $service);

        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);

        $service->fill($request->all());

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service successfully modified!!');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service successfully deleted!!');
    }
}
