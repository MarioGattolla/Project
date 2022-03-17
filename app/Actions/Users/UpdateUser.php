<?php

namespace App\Actions\Users;

use App\Models\User;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdateUser
{
    use ActsAsAction;

    public function handle(Request $request , User $user): bool
    {
        $user -> fill($request->all());
        return $user->save();
    }

}
