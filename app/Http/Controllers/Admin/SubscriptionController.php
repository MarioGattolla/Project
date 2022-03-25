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

    public function index(User $user = null): View

    {
        return view('admin.subscriptions.index', [
            'user' => $user ?? \Auth::user(),
        ]);
    }

    public function show(Subscription $subscription): View
    {
        $this->authorize('view', $subscription);

        return view('admin.subscriptions.show', [
            'subscription' => $subscription,
        ]);
    }

    public function create(User $user = null): View
    {
        return view('admin.subscriptions.create', [
            'user' => $user ?? \Auth::user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'services' => 'array|required',
            'services.*' => 'int|exists:services,id',
        ]);


        $user = \Auth::user();
        if ($user->role->value == 'Admin') {
            $user_request = User::findOrFail($request->id);
        } else {
            $user_request = $user;
        }

        $services = $request->input('services');

        $start = Carbon::make($request->input('start'));

        $end = Carbon::make($request->input('end'));

        CreateNewSubscription::run($user_request , $start , $end, $services);
        /** @phpstan-ignore-line */

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created !!');
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
            'services' => 'array|required',
            'services.*' => 'int|exists:services,id',
        ]);

        $user = $subscription->user;

        $start = Carbon::make($request->input('start'));

        $end = Carbon::make($request->input('end'));

        $services = $request->input('services');

        UpdateSubscription::run($user, $start, $end, $subscription, $services);

        return redirect()->route('subscriptions.show', $subscription)->with('success', 'subscription modified!!');
    }

    public function destroy(Subscription $subscription): RedirectResponse
    {

        $this->authorize('delete', $subscription);

        DeleteSubscription::run($subscription);

        return redirect()->route('subscriptions.index')->with('success', 'subscription deleted!!');
    }


}
