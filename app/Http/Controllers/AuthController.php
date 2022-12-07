<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('AuthPage.login');
    }
    public function registerview()
    {
        return view('AuthPage.register');
    }
    public function register(Request $request)
    {
        $request->validate(
            [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed",
            ]
        );
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $result= $user->save();
            return view('AuthPage.login')->with('User Registered Sucessfully', $result);
    }
}