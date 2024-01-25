<?php

namespace App\Http\Controllers\System;

use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $usermodule;

    public function __construct(UserInterface $usermodule)
    {
        $this->usermodule = $usermodule;
    }

    public function list()
    {
        $users = User::all();
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.list', compact('users', 'roles', 'departments'));
    }

    public function detail($id)
    {
        $user = $this->usermodule->detail($id);
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.detail', compact('user', 'roles', 'departments'));
    }

    public function add(Request $request)
    {
        try {
            $reqData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'department_id' => $request->department,
                'is_disbaled' => $request->is_disabled ? 1 : 0
            ];

            $response = $this->usermodule->add($reqData);

            if ($response) {

                $response->assignRole($request->role);
                return redirect()->route('admin.user.list')->with('success', 'User Created Successfully');
            }

            return redirect()->route('admin.user.list')->with('failed', 'Something Went Wrong! Please try again later.');
        } catch (\Exception $e) {

            return redirect()->route('admin.user.list')->with('failed', $e->getMessage());

        }
    }

    public function update(Request $request)
    {
        try {
            $reqData = [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'department_id' => $request->department,
                'is_disabled' => $request->is_disabled ? 1 : 0
            ];

            if ($request->password) {
                $reqData['password'] = Hash::make($request->password);
            }

            $response = $this->usermodule->update($reqData);

            if ($response) {
                $response->syncRoles($request->role);
                return redirect()->route('admin.user.list')->with('success', 'User Updated Successfully');
            }

            return redirect()->route('admin.user.list')->with('failed', 'Something Went Wrong! Please try again later.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user.list')->with('failed', 'Something Went Wrong! Please try again later.');
        }

    }

    public function delete($id)
    {
        try {
            $deleted = User::destroy($id);

            if ($deleted)
                return redirect()->back()->with('success', 'User Successfully Deleted!');


//            return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', 'Something Went Wrong! Please try again later');

        }
    }

    public function assign_role1(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $user = User::where('id', $user_id)->first();
            $roles = $request->roles;

//            $user = $this->usermodule->detail($user_id);
            $user->syncRoles($roles);
            $roles = implode(',', $roles);

            return redirect()->back()->with('success', "$roles Role has been assigned to $user->name");
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }

    public function disable_enable_login($id)
    {
        $user = User::find($id);
        $user->is_disabled = $user->is_disabled ? 0 : 1;
        $user->save();

        $action = 'disabled';

        if (!$user->is_disabled) {
            $action = 'enabled';
        }

        return redirect()->back()->with('success', 'Login ' . $action . ' for user ' . $user->email);

    }
}
