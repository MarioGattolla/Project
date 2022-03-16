<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscription;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateNewSubscription
{
    use ActsAsAction;

    public function handle(Request $request): Model|Subscription
    {
        $subscription = Subscription::create($request->all());
        Subscription::create($request->all());

        $subscribed_services = $request->input('services', []);

        $subscription->services()->sync($subscribed_services);

        return $subscription;
    }

}
