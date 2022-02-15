<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

/** @var User[] $users */
class UserController extends Controller
{
    public function dashboard(User $user)
    {
        $user = Auth::user();
        switch ($user->role->value) {
            case 'Admin':
                return view('adminDashboard', [
                    'user' => $user,

                ]);
                break;

            case 'User':
                return view('dashboard', [
                    'user' => $user,
                ]);
                break;

            case 'Coach':
                return view('coachDashboard', [
                    'user' => $user,
                    'skills' => $user->skill()->pluck('name', 'service_id'),

                ]);
                break;
        }
    }

    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $user,
            'subscrived_skill' => $user->skill()->pluck('name', 'service_id'),

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

    public function store(Request $request): RedirectResponse
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

    public function beacoach(User $user): View
    {
        return view('admin.users.beacoach', [
            'user' => $user,
            'available_services' => Service::pluck('name', 'id')
        ]);

    }

    public function beacoachUpdate(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'services' => ' required',
        ]);

        $services = $request->input('services', []);

        $user->skill()->sync($services);

        $user->role = 'Coach';
        $user->fill($request->all());

        $user->save();

        return redirect()->route('users.show', $user)->with('success', 'You Became a Coach!!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted!!');
    }


}

