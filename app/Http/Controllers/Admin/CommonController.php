<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CommonController extends Controller
{
    public function dashboard()
    {
        $userid = session('userid');
        $data = User::find($userid);
        return view('admin.dashboard');
    }
    public function userProfile()
    {
        $userid = session('userid');
        $user = User::find($userid);
        return view('admin.profile', compact('user'));
    }
    public function userProfileHandler(Request $request)
    {
        $user = User::find(session('userid'));
        if (isset($request->name))
            $user->name = $request->name;
        if (isset($request->mobile))
            $user->mobile = $request->mobile;
        if (isset($request->password))
            $user->password = Hash::make($request->password);
        if (isset($request->address))
            $user->address = $request->address;
        if (isset($request->longitude))
            $user->longitude = $request->longitude;
        if (isset($request->latitude))
            $user->latitude = $request->latitude;
        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('public/img/provider/profile');
            $user->profile  = $file;
        }
        $result = $user->save();
        toast('Admin Details Updated Successfully', 'success')->autoClose(3000);
        return view('admin.profile', compact('user'))->with('success', 'User Updated Sucessfully');
    }
}
