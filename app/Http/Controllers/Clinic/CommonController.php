<?php

namespace App\Http\Controllers\Clinic;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CommonController extends Controller
{
    public function dashboard()
    {
        $userid = session('userid');
        $data = Clinic::find($userid);
        return view('clinic.dashboard');
    }
    public function userProfile()
    {
        $userid = session('userid');
        $user = Clinic::find($userid);
       
        return view('clinic.profile',compact('user'));
    }
    public function userProfileHandler(Request $request){
        $user = Clinic::find(session('userid'));
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
           $file = $request->file('image')->store('public/img/provider/profile');
           $user->profile  = $file;
       }
       $result = $user->save();
       toast('User Updated Successfully','success')->autoClose(3000);
       return view('clinic.profile',compact('user'))->with('success','User Updated Sucessfully');
    }
}
