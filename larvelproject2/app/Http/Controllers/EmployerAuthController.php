<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerAuthController extends Controller
{
    public function login(Request $request)
    {
        print_r($request);
        exit();
        $credentials = $request->only('username', 'password');
        var_dump(Auth::guard('employer')->attempt($credentials));
        exit();

        // if (Auth::guard('employer')->attempt($credentials)) {
        //     return response()->json(['message' => 'Login successful'], 200);
        // }

        // return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
