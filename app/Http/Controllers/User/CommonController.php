<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clinic as ModelsClinic;
use App\Models\ClinicFile;
use App\Models\Meeting;
use App\Models\Provider as ModelsProvider;
use App\Models\ProvidersFile;
use App\Models\Providersfile as ModelsProvidersfile;
use App\Models\User;
use Clinic;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use NunoMaduro\Collision\Provider;

class CommonController extends Controller
{
    public function dashboard()
    {
        $userid = session('userid');
        $data = User::find($userid);
        return view('users.dashboard',compact($data,'data'));
    }
    public function userProfile(){
            $userid = session('userid');
            $user = User::find($userid);
        return view('users.profile',compact($user,'user'));
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
       return view('users.profile',compact($user,'user'))->with('success','User Updated Sucessfully');
    }
    public function userCalendar(){
        return view('users.calendar')->with('info', 'Users Meetings');
    }
    public function providersFile(){
        $userid = session('userid');
        $user = User::find($userid);
        $meetings = Meeting::where('user_id', $user->id)->distinct()->get(['providers_id']);
        $providers = [];
        $details = [];
        foreach ($meetings as $meet){
            $temp = $meet['providers_id'];
            $temp1 = ModelsProvider::find($temp);
            $providers[] = $temp1;
            $providersfile = Providersfile::where('user_id',$user->id)->where('provider_id',$temp1->id)->get();
            foreach( $providersfile as $file){
                $details[] = array(
                    'provider_name' => $temp1->name,
                    'provider_id' => $temp1->id,
                    'file_name' => $file->file_name,
                    'file_url' => $file->file,
                    'file_id' => $file->id,
                );
            }
        }
    return view('users.providerfile',compact('providers','details'));
}
    public function providersFileStore(Request $request){
        $validator = FacadesValidator::make($request->all(), [
            "name" => "required",
            "file" => "required",
        ]);
         if ($validator->fails()) {
            toast('Error While Uploading the file!!','error')->autoClose(3000);
            return back()->with('error', 'Please Check Your Inputs');
        }
         $user = new ModelsProvidersfile();
         $user->file_name = $request->name;
         $user->user_id = $request->userid;
        $user->provider_id = $request->provider;
         if($request->hasFile('file')) {
            $file = $request->file('file')->store('public/ProvidersFiles/');
            $user->file  = $file;
        }
        $result = $user->save();
        toast('File Uploaded Successfully','success')->autoClose(3000);
        return redirect(route('user_providersfiles'))->with('success', 'File Uploaded Successfully');
}
public function providersFileDelete(Request $request){
        $data = ModelsProvidersfile::where('id',$request->id)->delete();
        if($data){
        toast('Successfully Deleted','success')->autoClose(3000);
        return redirect(route('user_providersfiles'));
        }
}
    public function clinicFile(){
        $userid = session('userid');
        $user = User::find($userid);
        $meetings = Meeting::where('user_id', $user->id)->distinct()->get(['clinic_id']);
        $providers = [];
        $details = [];
        foreach ($meetings as $meet){
            $temp = $meet['clinic_id'];
            $temp1 = ModelsClinic::find($temp);
            $providers[] = $temp1;
            $providersfile = ClinicFile::where('user_id',$user->id)->where('clinic_id',$temp1->id)->get();
            foreach( $providersfile as $file){
                $details[] = array(
                    'provider_name' => $temp1->name,
                    'provider_id' => $temp1->id,
                    'file_name' => $file->file_name,
                    'file_url' => $file->file,
                    'file_id' => $file->id,
                );
            }
        }
    return view('users.clinicfile',compact('providers','details'));
}
    public function clinicFileStore(Request $request){
        $validator = FacadesValidator::make($request->all(), [
            "name" => "required",
            "file" => "required",
        ]);
         if ($validator->fails()) {
            toast('Error While Uploading the file!!','error')->autoClose(3000);
            return back()->with('error', 'Please Check Your Inputs');
        }
         $user = new ClinicFile();
         $user->file_name = $request->name;
         $user->user_id = $request->userid;
        $user->clinic_id = $request->provider;
         if($request->hasFile('file')) {
            $file = $request->file('file')->store('public/ClinicFiles/');
            $user->file  = $file;
        }
        $result = $user->save();
        toast('File Uploaded Successfully','success')->autoClose(3000);
        return redirect(route('user_clinicfiles'))->with('success', 'File Uploaded Successfully');
}
public function clinicFileDelete(Request $request){
        $data = ClinicFile::where('id',$request->id)->delete();
        if($data){
        toast('Successfully Deleted','success')->autoClose(3000);
        return redirect(route('user_clinicfiles'));
        }
}
}