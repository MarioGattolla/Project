<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Role;

/** @var Role[] $roles */

use Illuminate\Http\Request;
use Illuminate\View\View;
use function React\Promise\all;

class RoleController extends Controller
{

    public function create(): View
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',

        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'role created !!');
    }

    public function index(): View
    {
        $roles = Role::all();
        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function edit(Role $role): View
    {
        return view('admin.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $role->fill($request->all());

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role modified!!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted!!');
    }
}

