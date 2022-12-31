<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clinic as ModelsClinic;
use App\Models\ClinicFile;
use App\Models\ClinicReview;
use App\Models\ClinicSlot;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\Message;
use App\Models\Provider as ModelsProvider;
use App\Models\ProviderReview;
use App\Models\ProvidersFile;
use App\Models\Providersfile as ModelsProvidersfile;
use App\Models\ProvidersSlot;
use App\Models\ProviderVisit;
use App\Models\User;
use Clinic;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use NunoMaduro\Collision\Provider;

class CommonController extends Controller
{
    public function dashboard()
    {
        $umeetings = Meeting::where('user_id', session('userid'))->where('is_completed', '0')->get()->count();
        $cmeetings = Meeting::where('user_id', session('userid'))->where('is_completed', '1')->get()->count();
        $dreviews = ProviderReview::where('user_id', session('userid'))->get()->count();
        $creviews = ClinicReview::where('user_id', session('userid'))->get()->count();
        $psent = ProvidersFile::where('user_id', session('userid'))->get()->count();
        $csent = ClinicFile::where('user_id', session('userid'))->get()->count();
        $userid = session('userid');
        $data = User::find($userid);
        return view('users.dashboard',compact('umeetings','cmeetings','dreviews','creviews','psent','csent'));
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
        if($request->hasFile('profile')) {
           $file = $request->file('profile')->store('public/img/user_profile');
           $user->profile  = $file;
       }
       $result = $user->save();
       toast('User Updated Successfully','success')->autoClose(3000);
       return view('users.profile',compact('user'))->with('success','User Updated Sucessfully');
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
public function scheduleMeet(){
        $user = User::find(session('userid'));
        $providers_with_slot = ProvidersSlot::distinct()->get('providers_id');
        $details = array();
        foreach($providers_with_slot as $temp){
            $provider = ModelsProvider::where('id',$temp['providers_id'])->first();
            $distance = ModelsProvider::select(
                "*",
                DB::raw("6371 * acos(cos(radians(" . $user->latitude . ")) 
            * cos(radians(providers.latitude)) 
            * cos(radians(providers.longitude) - radians(" . $user->longitude . ")) 
            + sin(radians(" . $user->latitude . ")) 
            * sin(radians(providers.latitude))) AS distance")
            )->whereNotNull('latitude')->whereNotNull('longitude')
                ->first();
            $details[] = array(
                    "provider_name" => $provider->name,
                    "provider_id" => $provider->id,
                    "distance" => $distance->distance,
            );
         }
        return view('users.meeting',compact('details'));
}
public function fetchProviderSlots(Request $request)
    {
        $user = User::find(session('userid'));
    
        $data['pslots'] = ProvidersSlot::where("providers_id",$request->provider)->where("is_reserved",'0')->get(["id", "start", "end"]);
        $providervisits = ProviderVisit::where('providers_id', $request->provider)->get();
        $data['clinics'] = array();
        foreach($providervisits as $value){
            // dd($value->clinic_id);
            $temp = ModelsClinic::where('id', $value->clinic_id)->first();
            $distance = ModelsClinic::select(
                "*",
                DB::raw("6371 * acos(cos(radians(" . $user->latitude . ")) 
            * cos(radians(clinics.latitude)) 
            * cos(radians(clinics.longitude) - radians(" . $user->longitude . ")) 
            + sin(radians(" . $user->latitude . ")) 
            * sin(radians(clinics.latitude))) AS distance")
            )->whereNotNull('latitude')->whereNotNull('longitude')
                ->first();
            $data['clinics'][] = array(
                    "name" => $temp->name,
                    "id" => $temp->id,
                    "distance" => round($distance->distance,2),
            );
        }
        return response()->json($data);
    }
    public function fetchClinicSlots(Request $request)
    {
        $data['cslots'] = ClinicSlot::where("clinic_id",$request->clinics)->get(["id", "start", "end"]);
        return response()->json($data);
    }
public function scheduleMeetSave(Request $request){
    $user = $request->validate(
        [
           "provider" => "required",
           "providers_slot" => "required",
           "clinic" => "required",
           "clinic_slot" => "required",
           "reason" => "required"
        ]
     );
        $meet = new Meeting();
        $meet->user_id = session('userid');
        $meet->providers_id = $request->provider;
        $meet->providers_slot_id = $request->providers_slot;
        $meet->clinic_id = $request->clinic;
        $meet->clinic_slot_id = $request->clinic_slot;
        $meet->reason = $request->reason;
        $meet->save();
        $pslot = ProvidersSlot::where('id',$request->providers_slot)->first();
        $pslot->is_reserved = 1;
        $pslot->save();
        $pslot = ClinicSlot::where('id',$request->clinic_slot)->first();
        $pslot->is_reserved = 1;
        $pslot->save();
        $member = new Member();
        $member->user_id = session('userid');
        $member->type = 'user';
        $member->meeting_at = $meet->id;
        $member->save();

        $member = new Member();
        $member->user_id = $request->provider;
        $member->type = 'provider';
        $member->meeting_at = $meet->id;
        $member->save();

        $member = new Member();
        $member->user_id = $request->clinic;
        $member->type = 'clinic';
        $member->meeting_at = $meet->id;
        $member->save();
        
        toast('Meeting Saved Awaiting Confirmation','success')->autoClose(3000);
        return redirect(route('schedulemeet'));
}
public function calendarMeeting(Request $request)
    {
        $user = User::find(session('userid'));
        $meeting = Meeting::where('user_id', $user->id)->get();
        $data = array();
        foreach ($meeting as $meeting){
            $doctor = ProvidersSlot::where('id', $meeting->providers_slot_id)->first();
            if($meeting->meeting_link!=null){
                $data[] = array(
                    'title' => $user->name,
                    'url' => $meeting->meeting_link,
                    'start' => $doctor->start,
                    'end' => $doctor->end
                );
            }else{
                $data[] = array(
                    'title' => $user->name,
                    'start' => $doctor->start,
                    'end' => $doctor->end
                );
            }
        }
        return response()->json($data);
    }
    public function Meetings(){
        $user = User::find(session('userid'));
        $meeting = Meeting::where('user_id', $user->id)->where('is_completed', '0')->get();
        $details = array();
        foreach ($meeting as $meet){
            $provider = ModelsProvider::where('id', $meet->providers_id)->first();
            $clinic = ModelsClinic::where('id',$meet->clinic_id)->first();
            $details[] = array(
                "provider" => $provider->name,
                "clinic" => $clinic->name,
                "_provider" => $meet->doctor_confirm,
                "_clinic" => $meet->clinic_confirm,
                "clinic_latitude" => $clinic->latitude,
                "clinic_longitude" => $clinic->longitude,
                "reason" => $meet->reason,
                "meet_id" => $meet->id,
                "meeting_link" => $meet->meeting_link
            );
        }
        return view('users.schedulemeeting',compact('details'));
    }
    public function completedMeetings(){
        $user = User::find(session('userid'));
        $meeting = Meeting::where('user_id', $user->id)->where('is_completed', '1')->get();
        $details = array();
        foreach ($meeting as $meet){
            $provider = ModelsProvider::where('id', $meet->providers_id)->first();
            $clinic = ModelsClinic::where('id',$meet->clinic_id)->first();
            $details[] = array(
                "provider" => $provider->name,
                "clinic" => $clinic->name,
                "provider_id" => $provider->id,
                "clinic_id" => $clinic->id,
                "reason" => $meet->reason,
                "meet_id" => $meet->id
            );
        }
        return view('users.completedmeeting',compact('details'));
    }
    public function providerReview(Request $request){
        if(ProviderReview::where('user_id',session('userid'))->where('meeting_id',$request->meetingid)->where('providers_id',$request->id)->first()){
            toast('You Have Already Reviewed this Meeting','info')->autoClose(3000);
            return redirect(route('completedMeetings'));
        }
        $details = $request->id;
        $details1 = $request->meetingid;
        return view('users.providerreview',compact('details','details1'));
    }
    public function providerReviewSave(Request $request){
        $user = $request->validate(
            [
               "rating" => "required",
               "review" => "required",
               "meetingid" => "required",
               "providerid" => "required",
               "userid" => "required"
            ]
         );
        $review = new ProviderReview();
        $review->rating = $request->rating;
        $review->user_id = $request->userid;
        $review->providers_id = $request->providerid;
        $review->meeting_id = $request->meetingid;
        $review->review = $request->review;
        $review->save();
        toast('Review Saved Sucsessfully','success')->autoClose(3000);
            return redirect(route('completedMeetings'));
    }
    public function clinicReview(Request $request){
        if(ClinicReview::where('user_id',session('userid'))->where('meeting_id',$request->meetingid)->where('clinic_id',$request->id)->first()){
            toast('You Have Already Reviewed this Meeting','info')->autoClose(3000);
            return redirect(route('completedMeetings'));
        }
        $details = $request->id;
        $details1 = $request->meetingid;
        return view('users.clinicreview',compact('details','details1'));
    }

    public function userschat(Request $request){
        $chats = Message::where('meeting_at', $request->id)->get();
        $messages = [];
        foreach($chats as $chat){
            $member = Member::where('id', $chat->member_id)->first();
            if($member->type=='user'){
                $user = User::where('id', $member->user_id)->first();
            }
            if($member->type=='provider'){
                $user = ModelsProvider::where('id', $member->user_id)->first();
            }
            if($member->type=='clinic'){
                $user = ModelsClinic::where('id', $member->user_id)->first();
            }
            $messages[] = array(
                    "message" => $chat->message,
                    "type" => $member->type,
                    "user_id" => $member->user_id,
                    "time" => $chat->created_at,
                    "name" => $user->name,
            );
        }
        return view("users.userschat",compact('messages'));
    }
    public function chats(){
        $user = User::find(session('userid'));
        $meeting = Meeting::where('user_id', $user->id)->where('is_completed', '0')->get();
        $details = array();
        foreach ($meeting as $meet){
            $provider = ModelsProvider::where('id', $meet->providers_id)->first();
            $clinic = ModelsClinic::where('id',$meet->clinic_id)->first();
            $details[] = array(
                "provider" => $provider->name,
                "clinic" => $clinic->name,
                "reason" => $meet->reason,
                "meet_id" => $meet->id,
            );
        }
        return view('users.chats',compact('details'));
    }
    public function sendMessage(Request $request){
        $member = Member::where('user_id',Session('userid'))->where('type','user')->where('meeting_at',$request->meeting_id)->first();
        $message = new Message();
        $message->member_id = $member->id;
        $message->message = $request->message;
        $message->meeting_at = $request->meeting_id;
        $message->save();
        return redirect(route('userschat',$request->meeting_id));
    }
}