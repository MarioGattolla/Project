<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Service;

/** @var Coach[] $coaches */
class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $this->authorize('viewAny', Coach::class);

        $coaches = Coach::all();
        return view('admin.coaches.index', [
            'coaches' => $coaches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.coaches.create',[
            'available_services' => Service::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coach $coach): RedirectResponse
    {
        $this->authorize('create', Coach::class);

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'age' => 'required',
            'birthday' => 'required|date',
        ]);

        Coach::create($request->all());

        $subscribed_services = $request->input('services', []);

        $coach->services()->sync($subscribed_services);

        return redirect()->route('coaches.index')->with('success', 'Coach successfully created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coach $coach): View
    {
        $this->authorize('view', $coach);

        return view('admin.coaches.show', [
            'coach' => $coach,
            'subscrived_services' =>$coach->services()->pluck('name', 'service_id'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach): View
    {
        $this->authorize('update', $coach);

        return view('admin.coaches.edit', [
            'coach' => $coach,
            'available_services' => Service::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach): RedirectResponse
    {
        $this->authorize('update', $coach);

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'age' => 'required',
            'birthday' => 'required|date',
        ]);

        $coach->fill($request->all());

        $subscribed_services = $request->input('services', []);

        $coach->services()->sync($subscribed_services);

        $coach->save();

        return redirect('coaches.show', $coach)->with('success', 'Coach successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coach $coach):RedirectResponse
    {
        $this->authorize('delete', $coach);

        $coach->delete();
        return redirect('coaches.index')->with('success', 'Coach successfully deleted !!');
    }
}
