<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    public function list()
    {
        $roles = Role::all();
        $users = User::all();
        $modules = Module::with('permissions')->whereHas('permissions')->get();

        return view('admin.roles.list', compact('roles', 'users', 'modules'));
    }

    public function create(Request $request)
    {
        try {

            $permissions = $request->permission;
            $role = Role::create(['name' => $request->name]);

            if ($role) {
                $role->syncPermissions($permissions);
                return redirect()->back()->with('success', 'Role Successfully Created!');
            } else {
                return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());

        }

    }

    public function update(Request $request)
    {

        try {
            $permissions = $request->permission;
            $role = Role::find($request->role_id);

            if ($role) {
                $role->name = $request->name;
                $role->save();
                $role->syncPermissions($permissions);
                return redirect()->back()->with('success', 'Role Updated Successfully!');
            } else {
                return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());

        }

    }

    public function delete($id)
    {
        try {
            $deleted = Role::destroy($id);

            if ($deleted)
                return redirect()->back()->with('success', 'Role Successfully Deleted!');


            return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());

        }
    }

}
