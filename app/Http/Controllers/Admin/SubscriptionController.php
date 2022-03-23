<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Actions\Subscriptions\CreateNewSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Actions\Subscriptions\UpdateSubscription;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

/** @var Subscription[] $subscriptions */
class SubscriptionController extends Controller

{

    public function index(User $user): View

    {
        return view('admin.subscriptions.index', [
            'user' => $user,
        ]);
    }

    public function show(User $user, Subscription $subscription): View
    {
        $this->authorize('view', $subscription);

        return view('admin.subscriptions.show', [
            'subscription' => $subscription,
            'user' => $user,
        ]);
    }

    public function create(User $user): View
    {
        return view('admin.subscriptions.create', [
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user): RedirectResponse
    {

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'services' => 'array|required',
            'services.*' => 'int|exists:services,id',
        ]);

        $start = Carbon::make($request->input('start'));

        $end = Carbon::make($request->input('end'));

        $services = $request->input('services');

        CreateNewSubscription::run($user, $start, $end, $services); /** @phpstan-ignore-line */

        return redirect()->route('subscriptions.index', $user)->with('success', 'Subscription created !!');
    }


    public function edit(User $user, Subscription $subscription): View
    {
        $this->authorize('update', $subscription);

        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user, Subscription $subscription): RedirectResponse
    {
        $this->authorize('update', $subscription);


        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'services' => 'array|required',
            'services.*' => 'int|exists:services,id',
        ]);

        $start = Carbon::make($request->input('start'));

        $end = Carbon::make($request->input('end'));

        $services = $request->input('services');

        UpdateSubscription::run($user, $start, $end, $subscription, $services);

        return redirect()->route('subscriptions.show', [$user, $subscription])->with('success', 'subscription modified!!');
    }

    public function destroy(User $user, Subscription $subscription): RedirectResponse
    {

        $this->authorize('delete', $subscription);

        DeleteSubscription::run($subscription);

        return redirect()->route('subscriptions.index', $user)->with('success', 'subscription deleted!!');
    }


}
