<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies=Company::paginate(10);
        //
        return view('companies.index2', compact('companies'));
    }

    public function getCompanies()
    {
        $data = Company::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255',
            'logo'             => 'string|max:255',
            'website'          => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:255',
            'password'         => 'required|string|min:8',
            'screenshot_time'  => 'nullable|date_format:H:i:s',
            'no_of_employees'  => 'nullable|integer|min:1',
            'allowed_email'    => 'nullable|string|email|max:255',
            'status'           => 'required|string|in:active,inactive',

        ]);

//        $status=null;
        if($request->input('status')==='active'){
            $status=true;
        }else{
            $status=false;
        }

        $password=Hash::make($request->input('password'));

        $company=new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');

        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->website= $request->input('website');
        $company->password = $password;
        $company->allowed_email=$request->input('allowed_email');
        $company->logo = $request->input('logo');
        $company->status=$status;

        $company->save();

        return response()->json([
            'message'=>'company added successfully!',
            'company'=> $company
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $company=Company::find($id);

        return response()->json(['company'=>$company]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $company=Company::find($id);

        return response()->json(['company'=>$company]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'             => 'string|max:255',
            'email'            => 'string|email|max:255',
            'logo'             => 'string|max:255',
            'website'          => 'string|max:255',
            'phone'            => 'string|max:20',
            'address'          => 'string|max:255',
            'password'         => 'nullable|string|min:8',
            'screenshot_time'  => 'nullable|date_format:H:i:s',
            'no_of_employees'  => 'nullable|integer|min:1',
            'allowed_email'    => 'nullable|string|email|max:255',
            'status'           => 'boolean',

        ]);


        $company=Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->logo = $request->input('logo');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->website= $request->input('website');
        $company->allowed_email=$request->input('allowed_email');
        $company->status=$request->input('status');

        $company->save();

        return response()->json([
            'message'=> 'company updated Successfully!',
            'company'=>$company
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $company=Company::find($id);
//        dd($company);
        if(!$company){
            return response()->json(['company not found']);
        }

        $company->delete();

        return response()->json(['message' => 'Company is deleted Successfully', 'company' => $company]);


    }
}
