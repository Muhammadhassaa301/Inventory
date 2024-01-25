<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class EmployeeController extends Controller
{
    public function store(Request $request){

       // dd($request->all());

        try{   $emplyee = new Employee();

            $emplyee->full_name = $request->full_name;
            $emplyee->employee_code = $request->employee_code;
            $emplyee->email = $request->email;
            $emplyee->phone = $request->phone;
            $emplyee->designation = $request->designation;
            $emplyee->department = $request->department;
            $emplyee->save();
    
            return response()->json([
    
                'success' => true,
                'message' => 'Emplyee Successfully Added',
                
    
            ]);}catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                
                ]);
            }
               
            

     


    }
}
