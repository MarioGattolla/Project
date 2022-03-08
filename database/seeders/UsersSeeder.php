<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->role(Role::admin)->count(1)->create([
            'email' => 'mario.gattolla@gmail.com',
            'password' => 'provaprova',
        ]);
        User::factory()->role(Role::coach)->withRandomSkills()->count(10)->create();
        User::factory()->role(Role::user)->withRandomSubscriptions()->withRandomPayments()->count(1000)->create();
    }
}
