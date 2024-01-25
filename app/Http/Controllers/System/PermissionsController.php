<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
//use App\Models\Module;
use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function list()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $modules = Module::all();

        return view('admin.permissions.list', compact('permissions', 'roles', 'modules'));

    }

    public function create(Request $request)
    {
        try {

            $permission = Permission::create(['name' => $request->name, 'module_id' => $request->filled('module_id') ? $request->module_id : null]);

            if ($permission) {
                return redirect()->back()->with('success', 'Permission Successfully Created!');
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
            $permission = Permission::find($request->permission_id);

            if ($permission) {
                $permission->name = $request->name;
                $permission->module_id = $request->module_id;
                $permission->save();
                return redirect()->back()->with('success', 'Permission Updated Successfully!');
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
            $deleted = Permission::destroy($id);

            if ($deleted)
                return redirect()->back()->with('success', 'Permission Successfully Deleted!');


            return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());

        }
    }

    public function add_module(Request $request)
    {
        try {
            $module = new Module();
            $module->name = $request->name;
            $module->save();

            return response()->json(['success' => 1, 'module' => $module]);
        } catch (\Exception $exception) {
            return response()->json(['failed' => 1, 'message' => $exception->getMessage()]);

        }
    }
}
