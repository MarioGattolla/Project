<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => $this->faker->randomElement(['Admin','User','Coach']),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

//    public function role(Role $role): UserFactory
//    {
//        return $this->state([
//            'role' => $role
//        ]);
//    }

    public function withRandomSkills(): UserFactory
    {

        return $this->afterCreating(function (User $user) {
            $services = Service::all();

            $skill_count = rand(1, $services->count());

            $skills = $services->random($skill_count);

            $user->skill()->sync($skills->pluck('id'));
        });
    }

    public function withRandomSubscriptions(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            Subscription::factory()->forUser($user)->withRandomServices()->create();
        });
    }

    public function withRandomPayments(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            Payment::factory()->forUser($user)->create();
        });
    }
}
