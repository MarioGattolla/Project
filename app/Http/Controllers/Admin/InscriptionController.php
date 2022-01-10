<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/** @var Inscription[] $inscriptions */

use App\Models\Inscription;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InscriptionController extends Controller

{
    public function create(): View
    {
        return view('admin.inscriptions.create', [
            'available_users' => User::pluck('name', 'id'),
            'available_services' => Service::pluck('name','id'),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Inscription::class);

        $this->validate($request, [
            'user_id' => 'required|exists:users',
            'service_id' => 'required|exists:services',
            'start',
        ]);

        Inscription::create($request->all());
        return redirect()->route('inscriptions.index')->with('success', 'Inscription created !!');
    }

    public function index(): View
    {
        $inscriptions = Inscription::all();
        return view('admin.inscriptions.index', [
            'inscriptions' => $inscriptions,

        ]);
    }

    public function show(Inscription $inscription): View
    {
        return view('admin.inscriptions.show', [
            'inscription' => $inscription,
        ]);
    }

    public function edit(Inscription $inscription): View
    {
        return view('admin.inscriptions.edit', [
            'inscription' => $inscription,
            'available_users' => User::pluck('name', 'id'),
            'available_services' => Service::pluck('name','id'),
        ]);
    }

    public function update(Request $request, Inscription $inscription)
    {
        $this->validate($request, [
            'time',
            'start',
            'end',
            'user_id',
            'service_id',
        ]);

        $inscription->fill($request->all());

        $inscription->save();

        return redirect()->route('inscriptions.index')->with('success', 'Inscription modified!!');
    }

    public function destroy(Inscription $inscription)
    {
        $inscription->delete();
        return redirect()->route('inscriptions.index')->with('success', 'Inscription deleted!!');
    }
}
