<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider as ModelsProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Provider;

class CommonController extends Controller
{
    public function dashboard()
    {
        $userid = session('userid');
        $data = ModelsProvider::find($userid);
        return view('providers.dashboard',compact($data,'data'));
    }
    public function userProfile(){
            $userid = session('userid');
            $user = ModelsProvider::find($userid);
        return view('users.profile',compact($user,'user'));
    }
    public function userProfileHandler(Request $request){
        $user = ModelsProvider::find(session('userid'));
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
       return view('users.profile',compact($user,'user'))->with('success','User Updated Sucessfully');
    }
}