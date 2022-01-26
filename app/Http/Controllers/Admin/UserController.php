<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/** @var User[] $users */
class UserController extends Controller
{
    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function index(): View
    {
        $users = User::paginate(20);

        return view('admin.users.index', [
            'users' => $users,
        ]);

    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);

    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required|password',
            'email' => 'required|email',
            'role' => 'required',
        ]);


        $user->fill($request->all());

        $user->save();

        return redirect()->route('users.show', $user)->with('success', 'User successfully updated !!');
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request):RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User successfully created!!');
    }

    public function destroy(User $user):RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted!!');
    }



}

