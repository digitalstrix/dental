<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use Dirape\Token\Token;



class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $user = $request->validate(
            [
                "email" => "required|email",
                "password" => "required",
            ]
        );
        if (!User::where('email', $request->email)->first()) {
            return redirect(route('admin_login'))->with('error', 'Admin is Not Registered');
        }
        $user = User::where('email', $request->email)->where('user_type', 'admin')->first();
        if (!Hash::check($request->password, $user->password)) {
            return redirect(route('admin_login'))->with('error', 'Incorrect Password');
        }
        if ($user) {
            $request->session()->put([
                'user_token' => $user->user_token,
                'useremail' => $user->email,
                'user_type' => $user->user_type,
                'name' => $user->name,
                'userid' => $user->id
            ]);
            if (session()->has('user_token')) {
                return redirect(route('admin_dashboard'))->with('success', 'Admin Logged In Sucessfully!');
            }
        }
    }

    public function register()
    {
        return view('admin.register');
    }

    public function register_submit(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "email" => "required|email|unique:users",
                "mobile" => "required|unique:users",
                "profile" => "required",
                "password" => "required|min:6|confirmed",
                
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->user_type = "admin";
        $user->password=Hash::make($request->password);
        if($request->hasFile('profile')) {
            $file = $request->file('profile')->store('public/img/admin/profile');
            $user->profile = $file;
        }
        $user->user_token = (new Token())->Unique('users', 'user_token', 60);
        $result = $user->save();
         $request->session()->put([
            'user_token' => $user->user_token,
            'useremail' => $user->email,
            'name' => $user->name,
            'user_type' => $user->user_type,
            'userid' => $user->id,
      ]);
      if(session()->has('user_token')){
         return redirect(route('admin_dashboard'))->with('success', 'Admin Registered Sucessfully!');
      }
    }
}
