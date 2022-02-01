<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Role: string
{
    case admin = 'Admin';
    case user = 'User';
    case coach = 'Coach';

    public static function values(): array
    {
        return Collection::make(self::cases())
            ->mapWithKeys(fn(Role $role) => [$role->name => $role->value])
            ->toArray();

    }
}
