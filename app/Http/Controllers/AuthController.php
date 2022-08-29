<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('username', 'password')))
        {
            return response()->json([
                'success' => true,
                'data' => route('home'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized login attempt',
        ]);
    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::guard('web')->logout();
        }

        return response()->json([
            'success' => true,
            'data' => route('login'),
        ]);
    }
}
