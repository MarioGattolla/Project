<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Services\CreateNewService;
use App\Actions\Services\DeleteService;
use App\Actions\Services\UpdateService;
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

        CreateNewService::make()->handle($request);

        return redirect()->route('services.index')->with('success', 'Service successfully created !!');
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('viewAny', Service::class);

        return view('admin.services.index');
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

        UpdateService::make()->handle($request, $service);

        return redirect()->route('services.index')->with('success', 'Service successfully modified!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Service $service): RedirectResponse
    {
        $this->authorize('delete', $service);

        DeleteService::make()->handle($service);

        return redirect()->route('services.index')->with('success', 'Service successfully deleted!!');
    }
}
