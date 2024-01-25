<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function list()
    {
        $departments = Department::all();
        return view('admin.departments.list', compact('departments'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error'=>$validator->errors()->all()], 500);
        }

        try {
            Department::create([
                'title' => $request->title
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Department Successfully Added'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $department = Department::find($id);

            $html = view('admin.departments.partials.edit_inner', compact('department'))->render();

            return response()->json([
                'success' => true, 'html' => $html
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);

        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error'=>$validator->errors()->all()], 500);
        }

        try {
            $department = Department::find($id);
            $department->title = $request->title;
            $department->save();

            return response()->json([
                'success' => true,
                'message' => 'Department Successfully Updated'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $department = Department::find($id);
            $department->delete();

            return redirect()->back()->with('success', 'Service Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

//        {{ old("variation.$loop->index.title") }}
//        {{ $variation['title'] }}
//        {{ $variation['price'] ?? '' }}
//        {{ $variation['title'] ?? '' }}




}
