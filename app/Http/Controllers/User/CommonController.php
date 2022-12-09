<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommonController extends Controller
{
    public function dashboard()
    {
       
        $userid = session('userid');
        $data = User::find($userid);
        return view('users.dashboard');
    }
    public function userProfile(){
            $userid = session('userid');
            $user = User::find($userid);
          
        return view('users.profile',compact('user'));
    }
    public function userProfileHandler(Request $request){
        $user = User::find(session('userid'));
        if(isset($request->name))
        $user->name = $request->name;
        if(isset($request->mobile))
        $user->mobile = $request->mobile;
        if(isset($request->password))
        $user->password=Hash::make($request->password);
        $user->address = $request->address;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        if($request->hasFile('image')) {
           $file = $request->file('image')->store('public/img/user_profile');
           $user->profile  = $file;
       }
       $result = $user->save();
       toast('User Updated Successfully','success')->autoClose(3000);
       return view('users.profile',compact('user'))->with('success','User Updated Sucessfully');
    }
}