<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();

        $view = match ($user->role->value) {
            'Admin' => 'admin-dashboard',
            'Coach' => 'coach-dashboard',
            default => 'user-dashboard',
        };

        return view($view)->with('user', $user);
    }
}
