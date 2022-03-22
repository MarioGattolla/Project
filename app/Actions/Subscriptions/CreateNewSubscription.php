<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Subscription run(User $user, CarbonInterface $start, CarbonInterface $end, array $subscribed_services)
 */
class CreateNewSubscription
{
    use ActsAsAction;

    public function handle(User $user, Carbon $start, Carbon $end, array $subscribed_services): Model|Subscription
    {
        $subscription = $user->subscriptions()->create([
            'start' => $start,
            'end' => $end,
        ]);

        $subscription->services()->sync($subscribed_services);

        return $subscription;
    }

}
