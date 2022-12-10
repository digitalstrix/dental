<?php

namespace App\Http\Controllers\User;

use  App\Models\User;

use Dirape\Token\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use RealRashid\SweetAlert\Facades\Alert;


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
      if(!User::where('email',$request->email)->where('user_type','user')->first()){
         return redirect(route('user_login'))->with('error', 'User is Not Registered');
     }
     $user = User::where('email',$request->email)->first();
     if(!Hash::check($request->password, $user->password)){
      return redirect(route('user_login'))->with('error', 'Incorrect Password');
     }
     if($user){
      $request->session()->put([
         'user_token' => $user->user_token,
         'useremail' => $user->email,
         'user_type' => $user->user_type,
         'name' => $user->name,
         'userid' => $user->id,
      ]);
         if(session()->has('user_token')){
            return redirect(route('user_dashboard'))->with('success', 'User Logged In Sucessfully!');
         }
     }
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
            "mobile" => "required|unique:users",
            "profile" => "required",
            "password" => "required|min:6|confirmed",
         ]
      );

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile = $request->mobile;
      $user->password=Hash::make($request->password);
      if($request->hasFile('profile')) {
         $file = $request->file('profile')->store('public/img/user_profile');
         $user->profile  = $file;
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
         return redirect(route('user_dashboard'))->with('success', 'User Registered Sucessfully!');
      }
      
   }
}