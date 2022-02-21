<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/** @var User[] $users */
class UserController extends Controller
{
    public function dashboard(): \Illuminate\Contracts\View\View
    {
        $user = Auth::user();

        $view = match ($user->role->value) {
            'Admin' => 'admin-dashboard',
            'Coach' => 'coach-dashboard',
            default => 'user-dashboard',
        };

        return view($view)->with('user', $user);
    }

    public function show(User $user): \Illuminate\Contracts\View\View
    {
        $this->authorize('view', $user);

        return view('admin.users.show', [
            'user' => $user,
            'subscrived_skill' => $user->skill()->pluck('name', 'service_id'),

        ]);
    }

    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate(20);

        return view('admin.users.index', [
            'users' => $users,
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
        $this->authorize('create', User::class);

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
        $this->authorize('delete', $user);

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted!!');
    }


}

