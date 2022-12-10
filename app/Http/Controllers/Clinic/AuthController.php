<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Clinic;
use Illuminate\Support\Facades\Hash;
use Dirape\Token\Token;

class AuthController extends Controller
{
    public function login()
    {
        return view('clinic.login');
    }

    public function login_submit(Request $request)
    {
        $user = $request->validate(
            [
                "email" => "required|email",
                "password" => "required",
            ]
        );
        if (!Clinic::where('email', $request->email)->first()) {
            return redirect(route('clinic_login'))->with('error', 'User is Not Registered');
        }
        $user = Clinic::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            return redirect(route('clinic_login'))->with('error', 'Incorrect Password');
        }
        if ($user) {
            $request->session()->put([
                'user_token' => $user->user_token,
                'useremail' => $user->email,
                'usertype' => $user->user_type,
                'name' => $user->name,
                'userid' => $user->id,
                'userimage' => $user->image
            ]);
            if (session()->has('user_token')) {
                return redirect(route('clinic_dashboard'))->with('success', 'User Logged In Sucessfully!');
            }
        }
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
                "mobile" => "required|unique:clinics",
                "image" => "required",
                "password" => "required|min:6|confirmed",
                
            ]
        );
        $user = new Clinic();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password=Hash::make($request->password);
        if($request->hasFile('image')) {
            $file = $request->file('image')->store('public/img/clinic/profile');
            $user->image  = $file;
        }
        $user->user_token = (new Token())->Unique('clinics', 'user_token', 60);
        $result = $user->save();
         $request->session()->put([
            'user_token' => $user->user_token,
            'useremail' => $user->email,
            'name' => $user->name,
            'userid' => $user->id,
            'userimage' => $user->image
      ]);
      if(session()->has('user_token')){
         return redirect(route('clinic_dashboard'))->with('success', 'User Registered Sucessfully!');
      }
    }
}