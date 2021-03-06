<?php

namespace App\Actions\Users;

use App\Enums\Role;
use App\Models\User;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UserBeACoachUpdate
{

    use ActsAsAction;

    public function handle(Request $request, User $user): bool
    {

        $services = $request->input('services', []);

        $user->skill()->sync($services);

        $user->role = Role::coach;
        $user->fill($request->all());

        return $user->save();
    }

}
