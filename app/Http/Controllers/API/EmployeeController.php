<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\ApisKey;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{
    public function __construct(Request $request)
    {
        $res = ApisKey::validate_web_api_request($request->header('api-key'));
        if($res == false){
            abort(404);
        }
    }
    
    #login employee
    public function login(Request $req){

        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password'=>"required",
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors->toJson()]);
        }

        $employee = Employee::with('company')->whereEmail($req->email)->first();
        
        if(!$employee)
        {
           return response()->json(['error' => true,'message'=>'Employee not found'],404);
        }

        if(!$employee->status){
            return response()->json(['error' => true,'message'=>'Employee status is deactivated.'],403);
        }
        else{

            $login = [
                'email' => $req->email,
                'password' => $req->password,
            ];

            
            if (Hash::check($req->password, $employee->password)) {
        
    
                return response()->json([ 
                    'token' => encrypt($req->email),
                    'message'=> "Logged-in successfully",
                    'employee' =>  $employee,
                ], 200);   
    
            }else{
                return response()->json(['error' => true, 'message' => 'Invalid credentials'],401);
            }
        }

    }

}
