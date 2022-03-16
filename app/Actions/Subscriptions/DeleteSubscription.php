<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscription;
use DefStudio\Actions\Concerns\ActsAsAction;

class DeleteSubscription
{
    use ActsAsAction;

    public function handle(Subscription $subscription): ?bool
    {
        return $subscription->delete();
    }

}
