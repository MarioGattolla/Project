<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;


use App\Actions\Users\CreateNewUser;
use App\Actions\Users\DeleteUser;
use App\Actions\Users\UpdateUser;
use App\Actions\Users\UserBeACoachUpdate;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;


class UserController extends Controller
{


    public function show(User $user): \Illuminate\Contracts\View\View
    {
        $this->authorize('view', $user);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        return view('admin.users.index', [
        ]);

    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('admin.users.edit', [
            'user' => $user,
        ]);

    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);


        UpdateUser::run($request, $user);

        return redirect()->route('users.show', $user)->with('success', 'User successfully updated !!');
    }

    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        CreateNewUser::run($request);

        return redirect()->route('users.index')->with('success', 'User successfully created!!');
    }

    public function be_a_coach(User $user): View
    {
        $this->authorize('beacoach', $user);

        return view('admin.users.beacoach', [
            'user' => $user,
        ]);

    }

    public function be_a_coach_update(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'services' => ' required',
        ]);

        UserBeACoachUpdate::run($request, $user);

        return redirect()->route('users.show', $user)->with('success', 'The User Became a Coach!!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        DeleteUser::run($user);

        return redirect()->route('users.index')->with('success', 'User successfully deleted!!');
    }


}

