<?php

namespace App\Actions\Users;

use App\Models\User;
use DefStudio\Actions\Concerns\ActsAsAction;

class DeleteUser
{
    use ActsAsAction;

    public function handle(User $user): ?bool
    {
        return $user->delete();
    }

}
