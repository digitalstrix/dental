<?php

namespace App\Http\Controllers\User;

use  App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
   public function login()
   {
      return view('users.login');
   }
   public function login_submit(Request $request)
   {

      $user = $request->validate(
         [
            "email" => "required|email",
            "password" => "required",
         ]
      );
      if (Auth::attempt($user)) {
         return redirect()->intended('/user/register')->with('success', ' login successfully!');
      }
      return back()->withErrors([
         'email' => 'invalid login details'
      ]);
   }
   

   public function register()
   {
      return view('users.register');
   }

   public function register_submit(Request $request)
   {
      $request->validate(
         [
            "name" => "required",
            "email" => "required|email|unique:users",
            "mobile" => "required",
            "profile" => "required",
            "password" => "required|min:8|confirmed",
         ]
      );

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile = $request->mobile;
      $user->password=Hash::make($request->password);
      $profile = $request->file('profile');

      //Move Uploaded File
      $destinationPath = 'users_profile';
      if ($profile) {
         $profile->move($destinationPath, date('YmdHi') . 'profile' . $profile->getClientOriginalName());
      }
      if ($profile) {
         $user->profile = $destinationPath . '/' . $profile->getClientOriginalName();
      }
      $result = $user->save();
      return view('users.login')->with('User Registered Sucessfully');
   }
}
