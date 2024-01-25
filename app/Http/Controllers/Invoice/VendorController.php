<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VendorController extends Controller
{
    public function list()
    {
        $vendors = Vendor::all();
        return view('admin.vendors.list', compact('vendors'));
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
            Vendor::create([
                'title' => $request->title,
                'address' => $request->address,
                'department_id' => Auth::user()->department_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vendor Successfully Added'
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
            $vendor = Vendor::find($id);

            $html = view('admin.vendors.partials.edit_inner', compact('vendor'))->render();

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
            $vendor = Vendor::find($id);
            $vendor->title = $request->title;
            $vendor->address = $request->address;
            $vendor->department_id = Auth::user()->department_id;
            $vendor->save();

            return response()->json([
                'success' => true,
                'message' => 'Vendor Successfully Updated'
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
            $vendor = Vendor::find($id);
            $vendor->delete();

            return redirect()->back()->with('success', 'Vendor Successfully Deleted');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

}
