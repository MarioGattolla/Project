<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        $start = new CarbonImmutable($this->faker->dateTimeThisYear);

        return [
            'start' => $start,
            'end' => $start->addDays(rand(20, 90)),
        ];
    }

    public function forUser(User $user): SubscriptionFactory
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    public function withRandomServices(): SubscriptionFactory
    {
        return $this->afterCreating(function(Subscription $subscription){
            $services = Service::all();

            $services_count = rand(1, $services->count());

            $subscribed_services = $services->random($services_count);

            $subscription->services()->sync($subscribed_services->pluck('id'));
        });
    }
}
