<?php

namespace App\Http\Controllers\Clinic;

use App\Models\Job;
use App\Models\Provider;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Meeting;
use App\Models\Service;
use App\Models\ClinicFile;
use App\Models\ClinicSlot;
use App\Models\ClinicVisit;
use App\Models\ClinicReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Applyjob;
use Illuminate\Support\Facades\Hash;
use App\Models\Clinic as ModelsClinic;
use App\Models\Provider as ModelsProvider;

class CommonController extends Controller
{
    public function dashboard()
    {
        $umeetings = Meeting::where('clinic_id', session('userid'))->where('is_completed', '0')->get()->count();
        $cmeetings = Meeting::where('clinic_id', session('userid'))->where('is_completed', '1')->get()->count();
        $previews = ClinicReview::where('clinic_id', session('userid'))->get()->count();
        $areviews = ClinicReview::where('clinic_id', session('userid'))->pluck('rating')->avg();
        $psent = ClinicFile::where('clinic_id', session('userid'))->get()->count();
        $userid = session('userid');
        $data = User::find($userid);
        return view('clinic.dashboard',compact('umeetings','cmeetings','previews','areviews','psent'));
    }
    public function userProfile()
    {
        $userid = session('userid');
        $user = Clinic::find($userid);

        return view('clinic.profile', compact('user'));
    }
    public function userProfileHandler(Request $request)
    {
        $user = Clinic::find(session('userid'));
        if (isset($request->name))
            $user->name = $request->name;
        if (isset($request->mobile))
            $user->mobile = $request->mobile;
        if (isset($request->password))
            $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('public/img/provider/profile');
            $user->image  = $file;
        }
        $result = $user->save();
        toast('User Updated Successfully', 'success')->autoClose(3000);
        return view('clinic.profile', compact('user'))->with('success', 'User Updated Sucessfully');
    }



    // edit details



    public function clinicCalendar()
    {
        return view('clinic.calendar')->with('info', 'Users Meetings');
    }
    public function clinicSlot()
    {
        $details = ClinicSlot::where('clinic_id', session('userid'))->get();
        return view('clinic.cliniclots', compact('details'))->with('info', 'Meetings Slots');
    }
    public function clinicSlotSave(Request $request)
    {
        $request->validate(
            [
                "userid" => "required",
                "start" => "required",
                "end" => "required",
            ]
        );
        $slot = new ClinicSlot();
        $slot->clinic_id = $request->userid;
        $slot->start = $request->start;
        $slot->end = $request->end;
        $slot->save();
        toast('Slot Saved Successfully', 'success')->autoClose(3000);
        $details = ClinicSlot::where('clinic_id', session('userid'))->get();
        return view('clinic.cliniclots', compact('details'))->with('info', 'Meetings Slots');
    }
    public function clinicSlotDelete(Request $request)
    {
        $slot = ClinicSlot::where('id', $request->id)->delete();
        toast('Deleted Sucessfully', 'success')->autoClose(3000);
        $details = ClinicSlot::where('clinic_id', session('userid'))->get();
        return view('clinic.cliniclots', compact('details'))->with('info', 'Meetings Slots');
    }
    public function clinicFile()
    {
        $userid = session('userid');
        $details = [];
        $temp1 = ModelsClinic::find($userid);
        $clinicfile = ClinicFile::where('clinic_id', $temp1->id)->get();
        foreach ($clinicfile as $file) {
            $user = User::where('id', $file->user_id)->first();
            $details[] = array(
                'user_name' => $user->name,
                'user_id' => $user->id,
                'file_name' => $file->file_name,
                'file_url' => $file->file,
                'file_id' => $file->id,
            );
        }
        return view('clinic.userfile', compact('details'));
    }
    public function clinicMap()
    {
        $userid = session('userid');
        $details = [];
        $user = ModelsClinic::find($userid);
        $lat = $user->latitude;
        $lon = $user->longitude;
        $clinic = ModelsClinic::select(
            "*",
            DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(clinics.latitude)) 
        * cos(radians(clinics.longitude) - radians(" . $lon . ")) 
        + sin(radians(" . $lat . ")) 
        * sin(radians(clinics.latitude))) AS distance")
        )->whereNotNull('latitude')->whereNotNull('longitude')
            ->get();
        $visit = ClinicVisit::where('clinic_id', $userid)->get();
        foreach ($visit as $visit) {
            $temp = ModelsClinic::select(
                "*",
                DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                * cos(radians(clinics.latitude)) 
                * cos(radians(clinics.longitude) - radians(" . $lon . ")) 
                + sin(radians(" . $lat . ")) 
                * sin(radians(clinics.latitude))) AS distance")
            )->whereNotNull('latitude')->whereNotNull('longitude')->where('id', $visit->clinic_id)->orderBy('distance')
                ->get();
            // dd($temp[0]['id']);
            $details[] = array(
                'id' => $temp[0]['id'],
                'name' => $temp[0]['name'],
                'distance' => $temp[0]['distance'],
            );
        }
        return view('clinic.clinicmap', compact('clinic', 'details'));
    }
    public function clinicMapSave(Request $request)
    {
        $userid = session('userid');
        if (ClinicVisit::where('clinic_id', $userid)->where('clinic_id', $request->clinic)->first()) {
            toast('Already You Opted for this Clinic Visit.', 'error')->autoClose(3000);
            return redirect(route('clinicMap'));
        }
        $new = new ClinicVisit();
        $new->clinic_id = $request->clinic;
        $new->providers_id = $userid;
        $new->save();
        toast('Successfully Opted for Clinic Visit.', 'success')->autoClose(3000);
        return redirect(route('providersMap'));
    }
    public function clinicMapDelete(Request $request)
    {
        $userid = session('userid');
        $visit = ClinicVisit::where('id', $request->id)->delete();
        toast('Sucess Delete.', 'success')->autoClose(3000);
        return redirect(route('clinicMap'));
    }
    public function addServiceSave(Request $request)
    {
        $service = new Service();
        $service->clinic_id = $request->userid;
        $service->service = $request->service;
        $service->save();
        toast('Sucess Saved.', 'success')->autoClose(3000);
        return redirect(route('addService'));
    }
    public function addService()
    {
        $details = Service::where('clinic_id', session('userid'))->get();
        return view('clinic.addservice', compact('details'));
    }
    public function myMeetings()
    {
        $user = ModelsClinic::find(session('userid'));
        $meeting = Meeting::where('clinic_id', $user->id)->get();
        $details = array();
        foreach ($meeting as $meet) {
            $provider = ModelsProvider::where('id', $meet->providers_id)->first();
            $clinic = ModelsClinic::where('id', $meet->clinic_id)->first();
            $clinictime = ClinicSlot::where('id', $meet->clinic_slot_id)->first();
            $details[] = array(
                "username" => $provider->name,
                "user_id" => $provider->name,
                "clinic" => $clinic->name,
                "_provider" => $meet->doctor_confirm,
                "_clinic" => $meet->clinic_confirm,
                "clinic_latitude" => $clinic->latitude,
                "clinic_longitude" => $clinic->longitude,
                "reason" => $meet->reason,
                "meet_id" => $meet->id,
                "meeting_link" => $meet->meeting_link,
                "slot_id" => $meet->providers_slot_id,
                "clinic_time" => $clinictime->start,
                "is_completed" => $meet->is_completed,
                "is_assistance" => $meet->is_assistance
            );
        }
        return view('clinic.mymeetings', compact('details'));
    }

    public function myMeetingConfirmation(Request $request)
    {
        $meet = Meeting::where('id', $request->id)->first();
        $meet->clinic_confirm = '1';
        $meet->save();
        toast('Meeting Confirmed From Your Side', 'success')->autoClose(3000);
        return redirect(route('clinic_myMeetings'));
    }


    public function myReview()
    {
        $review = ClinicReview::where('clinic_id', session('userid'))->get();
        $details = array();
        foreach ($review as $review) {
            $user = User::where('id', $review->user_id)->first();
            $meet = Meeting::where('id', $review->meeting_id)->first();
            $details[] = array(
                "username" => $user->name,
                "reason" => $meet->reason,
                "review" => $review->review,
                "rating" => $review->rating,
            );
        }
        return view('clinic.reviews', compact('details'));
    }
    public function haveAssistance(Request $request)
    {
        $meet = Meeting::where('id', $request->id)->first();
        $meet->is_assistance = '0';
        $meet->save();
        toast('You Opt, You have Assistance in your Clinic.', 'success')->autoClose(3000);
        return redirect(route('clinic_myMeetings'));
    }
    public function needAssistance(Request $request)
    {
        $meet = Meeting::where('id', $request->id)->first();
        $meet->is_assistance = '1';
        $meet->save();
        toast('Job is Posted Successfully', 'success')->autoClose(3000);
        $job = new Job;
        $job->clinic_id = $meet['clinic_id'];
        $job->meeting_id = $meet['id'];
        $job->clinic_slot_id = $meet['clinic_slot_id'];
        $job->save();
        return redirect(route('clinic_myMeetings'));
    }
    public function appliedJobs(){
        $clinic = session('userid');
        $jobs = Job::where('clinic_id', $clinic)->get();
        foreach ($jobs as $job){
            // dd($job);
            if(Applyjob::where('job_id',$job->id)->first()){
                $applied = Applyjob::where('job_id',$job->id)->get();
                foreach($applied as $data){
                    // dd($data);
                    $time = ClinicSlot::where('id',$job->clinic_slot_id)->first();
                    $meeting = Meeting::where('id',$job->meeting_id)->first();
                    $d_name = Provider::where('id',$meeting->providers_id)->first();
                    $details[] = array(
                        "name"=> $data->name,
                        "email" => $data->email,
                        "mobile" => $data->mobile,
                        "job_id" => $data->job_id,
                        "time" => $time->start,
                        "d_name" => $d_name->name,
                        "reason" => $meeting->reason,
                        "is_ended" => $job->is_ended,
                        "is_selected" => $data->is_selected,
                        "applied_id" => $data->id,
                    );
                }
            }else{
                $details = array();
            }
        }
        return view('clinic.myjobs', compact('details'));
    }
    public function endjob(Request $request){
        $temp = Job::find($request->id);
        if($temp->is_ended==1){
            $temp->is_ended = 0;
        }elseif($temp->is_ended==0){
            $temp->is_ended = 1;
        }
        $temp->save();
        toast('Status Saved.', 'success')->autoClose(3000);
        return redirect(route('appliedJobs'));
    }
    public function hirecandidate(Request $request){
        $temp = Applyjob::find($request->id);
        if($temp->is_selected==1){
            $temp->is_selected = 0;
        }elseif($temp->is_selected==0){
            $temp->is_selected = 1;
        }
        $temp->save();
        toast('Status Saved.', 'success')->autoClose(3000);
        return redirect(route('appliedJobs'));
    }
}