<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/** @var Service[] $services */

use App\Models\Service;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ServiceController extends Controller

{
    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Service::class);

        return view('admin.services.create');
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Service::class);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Service successfully created !!');
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('viewAny', Service::class);

        $services = Service::all();
        return view('admin.services.index', [
            'services' => $services
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Service $service): View
    {
        $this->authorize('update', $service);

        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, Service $service): RedirectResponse
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

    /**
     * @throws AuthorizationException
     */
    public function destroy(Service $service): RedirectResponse
    {
        $this->authorize('delete', $service);

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service successfully deleted!!');
    }
}
