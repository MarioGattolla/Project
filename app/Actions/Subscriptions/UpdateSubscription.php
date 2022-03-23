<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscription;
use App\Models\User;
use Carbon\CarbonInterface;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdateSubscription
{
    use ActsAsAction;

    public function handle( User $user, CarbonInterface $start, CarbonInterface $end, Subscription $subscription, array $subscribed_services): bool
    {


      $subscription->update([
           'user_id' => $user->id,
            'start' => $start,
            'end' => $end,
        ]);

        $subscription->services()->sync($subscribed_services);

        return $subscription->save();
    }

}
