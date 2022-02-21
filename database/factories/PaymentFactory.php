<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'quote' => $this->faker->numberBetween(0, 100),
            'date' => $this->faker->dateTimeThisYear,
        ];
    }

    public function forUser(User $user): PaymentFactory
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }
}
