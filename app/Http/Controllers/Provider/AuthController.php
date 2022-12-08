<?php

namespace App\Http\Controllers\Provider;

use  App\Models\User;
use  App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dirape\Token\Token;
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
                "email" => "required|email",
                "password" => "required",
            ]
        );
        if(!Provider::where('email',$request->email)->first()){
            return redirect(route('user_login_page'))->with('error', 'User is Not Registered');
        }
        $user = Provider::where('email',$request->email)->first();
        if(!Hash::check($request->password, $user->password)){
         return redirect(route('provider_login'))->with('error', 'Incorrect Password');
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
                return redirect(route('providers_dashboard'))->with('success', 'User Logged In Sucessfully!');
            }
        }
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
                "mobile" => "required|unique:users",
                "image" => "required",
                "password" => "required|min:6|confirmed",
                "user_type"=>"required|in:dentist,hygentist",
            ]
        );
        $user = new Provider();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->user_type = $request->user_type;
        $user->password=Hash::make($request->password);
        if($request->hasFile('image')) {
            $file = $request->file('image')->store('public/img/provider/profile');
            $user->image  = $file;
        }
        $user->user_token = (new Token())->Unique('users', 'user_token', 60);
        $result = $user->save();
         $request->session()->put([
            'user_token' => $user->user_token,
            'useremail' => $user->email,
            'user_type' => $user->user_type,
            'name' => $user->name,
            'userid' => $user->id
      ]);
      if(session()->has('user_token')){
         return redirect(route('providers_dashboard'))->with('success', 'User Registered Sucessfully!');
      }
    }
}