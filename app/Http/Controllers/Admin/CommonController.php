<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClinicReview;
use App\Models\Job;
use App\Models\Meeting;
use App\Models\ProviderReview;
use App\Models\Querie;
use Illuminate\Support\Facades\Hash;

class CommonController extends Controller
{
    public function dashboard()
    {
        
        $umeetings = Meeting::where('is_completed', '0')->get()->count();
        $cmeetings = Meeting::where('is_completed', '1')->get()->count();
        $ctreviews = ClinicReview::all()->count();
        $ptreviews = ProviderReview::all()->count();
        $qrecieve = Querie::all()->count();
        $jobs = Job::all()->count();
        $userid = session('userid');
        $data = User::find($userid);
        return view('admin.dashboard',compact('umeetings','cmeetings','ctreviews','ptreviews','qrecieve','jobs'));
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
    public function usersDetails()
    {
        $details = User::where('user_type','user')->get();
        return view('admin.users', compact('details'));
    }
    public function providersDetails()
    {
        $details = Provider::all();
        return view('admin.providers', compact('details'));
    }
    public function clinicsDetails()
    {
        $details = Clinic::all();
        return view('admin.clinics', compact('details'));
    }
    public function deleteUser($id)
    {

        User::findorfail($id)->delete();
        $details = User::all();
        return view('admin.users', compact('details'))->with('success', 'User Deleted Sucessfully');
    }
    public function deleteProvider($id)
    {

        Provider::findorfail($id)->delete();
        $details = Provider::all();
        return view('admin.providers', compact('details'))->with('success', 'Provider Deleted Sucessfully');
    }
    public function deleteClinic($id)
    {

        Clinic::findorfail($id)->delete();
        $details = Clinic::all();
        return view('admin.clinics', compact('details'))->with('success', 'Clinic Deleted Sucessfully');
    }
    public function queries(){
        $queries = Querie::all();
        return view('admin.messages',compact('queries'));
    }
}