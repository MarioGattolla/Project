<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'price' => $this->faker->numberBetween(0, 100),
            'name' => $this->faker->randomElement(['Palestra', 'Piscina', 'Pilates', 'Yoga', 'Karate']),

        ];
    }
}
