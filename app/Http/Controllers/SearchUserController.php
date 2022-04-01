<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchUserController extends Controller
{
    public function index(): View
    {
        return view('admin.subscriptions.create');
    }

    public function search(Request $request)
    {
        re
        if ($request->ajax()) {
            $output = "";
            $users = DB::table('users')->where('surname', 'LIKE', '%' . $request->search . "%")
                ->get(['id', 'name', 'surname', 'email']);
           return response($users);
        }
    }
}
