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
        return view('admin.services.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Service created !!');
    }

    public function index(): View
    {
        $services = Service::all();
        return view('admin.services.index', [
            'services' => $services
        ]);
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description',
        ]);

        $service->fill($request->all());

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service modified!!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted!!');
    }
}
