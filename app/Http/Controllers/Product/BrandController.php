<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function list()
    {
        $brands = Brand::all();
        return view('admin.brands.list', compact('brands'));
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
            Brand::create([
                'title' => $request->title,
                'description' => $request->description,
                'department_id' => Auth::user()->department_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Brand Successfully Added'
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
            $brand = Brand::find($id);

            $html = view('admin.brands.partials.edit_inner', compact('brand'))->render();

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
            $brand = Brand::find($id);
            $brand->title = $request->title;
            $brand->description = $request->description;
            $brand->department_id = Auth::user()->department_id;
            $brand->save();

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
            $brand = Brand::find($id);
            $brand->delete();

            return redirect()->back()->with('success', 'Brand Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }




}
