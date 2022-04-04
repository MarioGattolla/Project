<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchUserController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {

            $users = DB::table('users')->where('surname', 'like', "%" . $request->search . "%")
                ->get(['id', 'name', 'surname', 'email']);
            return response($users);
        }
    }
}
