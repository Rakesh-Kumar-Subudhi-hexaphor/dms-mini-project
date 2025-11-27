<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    //
    public function index()
    {
        $users = Admin::all();
        return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role_id' => 'required',
        ]);


        $user = Admin::create($request->only('name', 'email', 'phone') + ['password' => Hash::make($request->password)]);

        $role = Role::find($request->role_id);
        if (!blank($user) && !blank($role)) {
            $user->assignRole($role->name);
        }
        $user->givePermissionTo(Permission::role($role->name)->get());

        return redirect()->route('admin.user')->with('success', 'User Created!!');
    }
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('roles', 'admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable',
            'password' => 'nullable',
            'password_confirm' => 'required_if:password,1|same:password',
            'role_id' => 'required',
        ]);

        // Update basic user information (name, email, phone)
        $admin->update($request->only('name', 'email', 'phone'));

        if ($request->password) {
            $admin->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // Remove old role
        $oldRole = $admin->roles->first(); // Assuming the user has only one role, change it accordingly if multiple roles are possible

        if ($oldRole) {
            $admin->removeRole($oldRole);
            $permissionsToRemove = Permission::role($oldRole->name)->get();
            foreach ($permissionsToRemove as $permission) {
                $admin->revokePermissionTo($permission->name);
            }
        }

        // Assign new role
        $role = Role::findById($request->role_id);
        $admin->assignRole($role);

        $admin->givePermissionTo(Permission::role($role->name)->get());

        return redirect()->route('admin.user')->with('success', 'User Update');
    }
}
