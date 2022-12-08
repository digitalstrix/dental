<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Clinic;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
  public function login()
    {
        return view('Clinic.login');
    }

    public function login_submit(Request $request)
    {
       
        $user = $request->validate(
            [
                "email" => "required|email",
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
        return view('clinic.register');
    }

    public function register_submit(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "email" => "required|email|unique:clinics",
                "mobile" => "required",
                "password" => "required|min:8|confirmed",
                "image" => "required",
              
            ]
        );

        $user = new Clinic();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password=Hash::make($request->password);
      
        $profile = $request->file('image');

        //Move Uploaded File
        $destinationPath = 'Providers_profile';
        if ($profile) {
            $profile->move($destinationPath, date('YmdHi') . 'profile' . $profile->getClientOriginalName());
        }
        if ($profile) {
            $user->image = $destinationPath . '/' . $profile->getClientOriginalName();
        }
        $result = $user->save();
        return view('Clinic.login')->with('User Registered Sucessfully');
    }

}
