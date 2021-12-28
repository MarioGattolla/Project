<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

/** @var User[] $users */

use Illuminate\Http\Request;
use Illuminate\View\View;
use function React\Promise\all;

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
            'available_roles' => Role::pluck('name', 'id'),
        ]);

    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->fill($request->all());

        $user->save();

        return redirect()->route('users.show', $user)->with('success', 'Utente modificato correttamente!!');
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'available_roles' => Role::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'Utente creato correttamente!!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utente eliminato correttamente!!');
    }

}

