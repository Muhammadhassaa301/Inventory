<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class WQController extends Controller
{
    public function showall()
    {
        $stu = Student::all();

        //dd($stu);

        return view('wqv.studentlist', compact('stu'));
    }

    public function edit($id)
    {
        try {
            $stu = Student::find($id);
          
            return view('wqv.studentedit', compact('stu'));

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $stu = Student::find($id);
            

            $stu->FirstName = $request->FirstName;
            $stu->LastName = $request->LastName;
            
            $stu->save();

            return redirect()->route('students.showall');

            //return redirect()->back()->with('success', 'Product Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function addstudent()
    {
        $stu = Student::all();
        return view('wqv.add', compact('stu'));
    }
    public function store(Request $request)
    {
        try {
            $stu1 = [
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName
            ];

            //dd($stu);

            $stu = Student::create($stu1);

            // $stu=new Student();
            // $stu->FirstName=$request->FirstName;
            // $stu->LastName=$request->LastName;
            // $stu->save();

            




            
            // $stu = Student::create([
            //     'FirstName' => $request->FirstName,
            //     'LastName' => $request->LastName
            // ]);

            return redirect()->route('students.showall');

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stu = Student::find($id);
            $stu->delete();

            return redirect()->route('students.showall');

        } catch (\Exception $e) {

            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
    
}
