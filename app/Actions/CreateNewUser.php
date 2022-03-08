<?php

namespace App\Actions;

use DefStudio\Actions\Concerns\ActsAsAction;
use App\Models\User;
use Illuminate\Http\Request;

class CreateNewUser
{
    use ActsAsAction;

    public function handle(Request $request)
    {
        return User::create($request->all());
    }

}
