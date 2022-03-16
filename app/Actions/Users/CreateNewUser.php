<?php

namespace App\Actions\Users;

use App\Models\User;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateNewUser
{
    use ActsAsAction;

    public function handle(Request $request): Model|User
    {
        return User::create($request->all());
    }

}
