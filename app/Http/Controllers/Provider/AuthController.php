<?php

namespace App\Http\Controllers\Provider;

use  App\Models\User;
use  App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('providers.login');
    }

    public function login_submit(Request $request)
    {
       
        $user = $request->validate(
            [
                "email" => "required|email|unique:providers",
                "password" => "required",
            ]
        );
      
        if (Auth::guard('provider')->attempt($user))  {
            return redirect()->intended('/user/register')->with('success', ' login successfully!');
        }
        return back()->withErrors([
            'email' => 'invalid login details'
        ]); 
    }

    public function register()
    {
        return view('providers.register');
    }

    public function register_submit(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "email" => "required|email|unique:users",
                "mobile" => "required",
                "image" => "required",
                "password" => "required|min:8|confirmed",
                "user_type"=>"required",
            ]
        );

        $user = new Provider();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->user_type = $request->user_type;
        $user->password=Hash::make($request->password);
        $profile = $request->file('image');

        //Move Uploaded File
        $destinationPath = 'providers_profile';
        if ($profile) {
            $profile->move($destinationPath, date('YmdHi') . 'profile' . $profile->getClientOriginalName());
        }
        if ($profile) {
            $user->image = $destinationPath . '/' .$profile->getClientOriginalName();
        }
        $result = $user->save();
        return view('providers.login')->with('User Registered Sucessfully');
    }
}