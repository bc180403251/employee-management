<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees=Employee::orderBy('created_at','desc')->with('company')->paginate(10);

        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $companies=Company::where('status', true)->get();

        return response()->json([

            'companies'=>$companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
//        $request->validate([
//            'company_id'       => 'required|integer|exists:companies,id',
//            'name'             => 'required|string|max:255',
//            'email'            => 'required|email|unique:employees,email',
//            'phone'            => 'required|string|max:20',
//            'password'         => 'required|string',
//            'profile_img'    => 'string',
//            'status'           => 'required',
//        ]);

        $status=false;

        if($request->input('status')==='active'){
            $status=true;
        }
        $password=Hash::make($request->input('password'));

        $employee = new Employee();
        $employee->company_id = $request->input('company_id');
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->password = $password ;
        $employee->profile_img = $request->input('profile_img');
        $employee->status = $status;
        $save=$employee->save();

        if($save){
            $company = Company::find($request->input('company_id'));
            if ($company) {
                $company->no_of_employees += 1; // Increment the employee count
                $company->save(); // Save the updated company record
            }
        }


        Session::flash('message','Employee Added Successfully!');

        return response()->json(['message'=>'Employee Added Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employee=Employee::with('company')->find($id);

        return response()->json(['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $companies=Company::where('status', true)->get();

        $employee=Employee::find($id);

        return response()->json([
            'companies'=> $companies,
            'employee' =>$employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->profile_img = $request->input('profile_img');
        $employee->company_id = $request->input('company_id');
        $employee->status = $request->input('status');

        $employee->save();

        Session::flash('message','Employee Updated Successfully!');
        return response()->json([
            'message'=>'employee updated successfully!'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employee=Employee::with('company')->find($id);

        if($employee){
            $employee->company->no_of_employees -= 1;

            $employee->company->save();
        }
        $employee->delete();

        Session::flash('message','Employee DeletedSuccessfully!');
        return response()->json([
            'message'=>'employee deleted successfully!'
        ]);
    }
}
