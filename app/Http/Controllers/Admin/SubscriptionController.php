<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/** @var Subscription[] $subscriptions */

use App\Models\Subscription;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller

{
    public function create(): View
    {
        return view('admin.subscriptions.create', [
            'available_users' => User::pluck('surname', 'id'),
            'available_services' => Service::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Subscription::class);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $subscription = Subscription::create($request->all());

        $subscribed_services = $request->input('services', []);

        $subscription->services()->sync($subscribed_services);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created !!');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Subscription::class);

        $subscriptions = Subscription::all();
        return view('admin.subscriptions.index', [
            'subscriptions' => $subscriptions,

        ]);
    }

    public function show(Subscription $subscription): View
    {
        $this->authorize('view', $subscription);

        return view('admin.subscriptions.show', [
            'subscription' => $subscription,
            'subscrived_services' =>$subscription->services()->pluck('name', 'service_id'),


        ]);
    }

    public function edit(Subscription $subscription): View
    {
        $this->authorize('update', $subscription);

        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
            'available_services' => Service::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, Subscription $subscription): RedirectResponse
    {
        $this->authorize('update', $subscription);

        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);



        $subscribed_services = $request->input('services', []);

        $subscription->services()->sync($subscribed_services);

        $subscription->fill($request->all());

        $subscription->save();

        return redirect()->route('subscriptions.index')->with('success', 'subscription modified!!');
    }

    public function destroy(Subscription $subscription): RedirectResponse
    {

        $this->authorize('delete', $subscription);

        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'subscription deleted!!');
    }


}
