<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscription;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdateSubscription
{
    use ActsAsAction;

    public function handle(Request $request, Subscription $subscription): bool
    {

        $subscribed_services = $request->input('services', []);

        $subscription->services()->sync($subscribed_services);

        $subscription->fill($request->all());

        return $subscription->save();
    }

}
