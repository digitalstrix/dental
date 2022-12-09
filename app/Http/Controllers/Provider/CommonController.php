<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  App\Models\Provider;


class CommonController extends Controller
{
    public function dashboard()
    {
        $userid = session('userid');
        $data = Provider::find($userid);
        return view('providers.dashboard');
    }
    public function userProfile(){
            $userid = session('userid');
            $user = Provider::find($userid);
        return view('providers.profile',compact('user'));
    }
    public function userProfileHandler(Request $request){
        $user = Provider::find(session('userid'));
        if(isset($request->name))
        $user->name = $request->name;
        if(isset($request->mobile))
        $user->mobile = $request->mobile;
        if(isset($request->password))
        $user->password=Hash::make($request->password);
        if(isset($request->address))
        $user->address = $request->address;
        if(isset($request->longitude))
        $user->longitude = $request->longitude;
        if(isset($request->latitude))
        $user->latitude = $request->latitude;
        if(isset($request->profile))
        if($request->hasFile('profile')) {
           $file = $request->file('profile')->store('public/img/provider_profile');
           $user->profile  = $file;
        }
       $result = $user->save();
       toast('User Updated Successfully','success')->autoClose(3000);
       return view('providers.profile',compact('user'))->with('success','User Updated Sucessfully');
    }
}