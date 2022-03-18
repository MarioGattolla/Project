<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $view = match ($user->role->value) {
            'Admin' => 'admin-dashboard',
            'Coach' => 'coach-dashboard',
            default => 'user-dashboard',
        };

        return view($view)->with('user', $user);
    }
}
