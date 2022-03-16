<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Actions\Subscriptions\CreateNewSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Actions\Subscriptions\UpdateSubscription;
use App\Http\Controllers\Controller;

/** @var Subscription[] $subscriptions */

use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller

{
    public function create(): View
    {
        $this->authorize('create', Subscription::class);

        return view('admin.subscriptions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Subscription::class);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        CreateNewSubscription::make()->handle($request);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created !!');
    }

    public function index(): View
    {
        $this->authorize('viewAny', Subscription::class);

        return view('admin.subscriptions.index');
    }

    public function show(Subscription $subscription): View
    {
        $this->authorize('view', $subscription);

        return view('admin.subscriptions.show', [
            'subscription' => $subscription,
        ]);
    }

    public function edit(Subscription $subscription): View
    {
        $this->authorize('update', $subscription);

        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
        ]);
    }

    public function update(Request $request, Subscription $subscription): RedirectResponse
    {
        $this->authorize('update', $subscription);


        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        UpdateSubscription::make()->handle($request, $subscription);

        return redirect()->route('subscriptions.show', $subscription)->with('success', 'subscription modified!!');
    }

    public function destroy(Subscription $subscription): RedirectResponse
    {

        $this->authorize('delete', $subscription);

        DeleteSubscription::make()->handle($subscription);

        return redirect()->route('subscriptions.index')->with('success', 'subscription deleted!!');
    }


}
