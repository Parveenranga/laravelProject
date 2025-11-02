<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;  // ← Import Candidate model
use App\Models\Education;  // ← If you also use Education
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function candidateregistration()
    {
        // your logic here
        // echo "WOkring<script>alert()</script>";
       return view('candidateregistration'); // for example
    }
    public function store(Request $request)
    {
        // print_r($request->education[0]['type']);
        // exit();
        // Validate basic details
      $formType = $request->input('form_type');

    if ($formType === 'candidate') {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            // 'password' => 'required|string',
        ]);

        DB::insert('INSERT INTO candidate (name, email,mobileno,dob, eductation ,education_file,created_at,status) VALUES (?, ? ,? , ? ,?, ?,?,?)', [
            $request->name,
            $request->email,
            $request->mobile,
            $request->dob,
            $request->education[0]['type'],
           "",
           date('Y-m-d'),
           1
           
        ]);

        return response()->json(['message' => 'Candidate registered successfully']);
        // echo "working";
    }else if ($formType === 'employer') {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'doincorporation' => 'required|date|before:today',
             'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=(?:.*[A-Za-z]){4,})(?=(?:.*\d){2,})(?=.*[A-Z])(?=.*[\W_]).+$/',
            ],
             'cpassword' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=(?:.*[A-Za-z]){4,})(?=(?:.*\d){2,})(?=.*[A-Z])(?=.*[\W_]).+$/',
            ],
             'address' => 'required|string',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            // 'password' => 'required|string',
        ]);
         $logoPath = $request->file('logo')->store('logos', 'public');
        DB::insert('INSERT INTO employer (company_name, company_mobile_no,company_emailid,password, date_of_incorporation ,address,create_at,status,update_at,logo_path) VALUES (?, ? ,? , ? ,?, ?,?,?,?,?)', [
            $request->name,
            $request->email,
            $request->mobile,
            $request->password,
            $request->doincorporation,
            $request->address,
         
           date('Y-m-d'),
           1,
           date('Y-m-d'),
           $logoPath
           
        ]);

        return response()->json(['message' => 'Employer registered successfully']);
        // echo "working";
    }
    }
    public function employerregistration()
    {
        
       return view('employerregistration'); 
    }
    public function employerlogin()
    {
        
       return view('employerlogin'); 
    }
    public function candidatelogin()
    {
        
       return view('candidatelogin'); 
    // echo "working";

    }
    public function loginstore(Request $request)
{
    // ✅ Validate the input
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);


    // ✅ Validate input
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $username = $request->input('username');
    $password = $request->input('password');

    // ✅ Fetch user manually from DB
    $employer = DB::table('employer')
        ->where('company_emailid', $username)
        ->first();
    // var_dump( $employer);
    // exit();
    // ✅ Check if user exists and password is correct
    // var_dump($employer->password);
    // var_dump($password);
    // exit();
    if ($employer && ($password== $employer->password)) {
        // echo "working";
        // exit();
        // ✅ Manually set session (since not using Auth here)
        Session::put('employer_id', $employer->id);
        Session::put('employer_name', $employer->company_name);
        Session::put('employer_emailid', $employer->company_emailid);

        // ✅ Return success
        return response()->json([
            'message' => 'Login successful',
            'redirect' => route('employer.dashboard') // Change as needed
        ], 200);
    }else{
         return response()->json([
            'message' => 'Login Fail',
         
        ], 400);
    }
    
    
}
   
}