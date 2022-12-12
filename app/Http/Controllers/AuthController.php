<?php

namespace App\Http\Controllers;

use App\Models\Applyjob;
use App\Models\Clinic;
use App\Models\ClinicReview;
use App\Models\ClinicSlot;
use App\Models\Job;
use App\Models\Meeting;
use App\Models\Provider;
use App\Models\ProviderReview;
use App\Models\Querie;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function dashboard()
    {  $reviews = ProviderReview::all();
        // $review = array();
        foreach($reviews as $r){
            $temp = User::find($r->user_id);
            $review[] = array(
                "name" => $temp->name,
                "review" => $r->review,
                "image" => $temp->profile
            );  
        }
        $doctor = Provider::all();
        $clinic = Clinic::all();
        return view('frontend.index',compact('review','doctor','clinic'));
    }
    public function providers()
    {  
            $doctor = Provider::all();
        return view('frontend.dentist',compact('doctor'));
    }
    public function clinics()
    {  
            $doctor = Clinic::all();
        return view('frontend.clinic',compact('doctor'));
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function contactSave(Request $request){
        $user = $request->validate(
            [
                "email" => "required|email",
                "message" => "required",
                "subject" => "required",
                "name" => "required",
            ]
        );
        $q = new Querie();
        $q->name = $request->name;
        $q->email = $request->email;
        $q->subject = $request->subject;
        $q->message = $request->message;
        $q->save();
        return redirect(route('contact_frontend'))->with('error', 'Message Sent !!!');
    }
    
    public function login(Request $request)
    {
        return view('AuthPage.login');
    }
    public function registerview()
    {
        return view('AuthPage.register');
    }
    public function register(Request $request)
    {
        $request->validate(
            [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed",
            ]
        );
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $result= $user->save();
            return view('AuthPage.login')->with('User Registered Sucessfully', $result);
    }
    public function providePage(Request $request){
        $doctor = Provider::find($request->id);
        $tr = ProviderReview::where('providers_id', $request->id)->get()->count();
        $ar = ProviderReview::where('providers_id', $request->id)->pluck('rating')->avg();
        $cm = Meeting::where('providers_id', $request->id)->where('is_completed', '1')->get()->count();
        $reviews = ProviderReview::where('providers_id', $request->id)->get();
        $review = array();
        foreach($reviews as $r){
            $temp = User::find($r->user_id);
            $review[] = array(
                "name" => $temp->name,
                "review" => $r->review,
                "image" => $temp->profile,
                "rating" => $r->rating
            );  
        }
        return view('frontend.provider',compact('doctor','tr','ar','tr','cm','review'));
    }
    public function clinicPage(Request $request){
        $doctor = Clinic::find($request->id);
        $tr = ClinicReview::where('clinic_id', $request->id)->get()->count();
        $ar = ClinicReview::where('clinic_id', $request->id)->pluck('rating')->avg();
        $cm = Meeting::where('clinic_id', $request->id)->where('is_completed', '1')->get()->count();
        $reviews = ClinicReview::where('clinic_id', $request->id)->get();
        $review = array();
        foreach($reviews as $r){
            $temp = User::find($r->user_id);
            $review[] = array(
                "name" => $temp->name,
                "review" => $r->review,
                "image" => $temp->profile,
                "rating" => $r->rating
            );  
        }
        $service = Service::where('clinic_id',$request->id)->get();
        return view('frontend.clinics',compact('doctor','tr','ar','tr','cm','review','service'));
    }
    public function jobs(){
        $jobs = Job::where('is_ended','0')->get();
        foreach($jobs as $job){
            $clinic = Clinic::where('id',$job->clinic_id)->first();
            $meeting = Meeting::where('id',$job->meeting_id)->first();
            $timing = ClinicSlot::where('id',$job->clinic_slot_id)->first();
            $details[] = array(
                "meeting" => $meeting->reason,
                "clinic_name" => $clinic->name,
                "clinic_location" => $clinic->address,
                "start" => $timing->start,
                "end" => $timing->end,
                "doctor" => $meeting->providers_id,
                "job_id" => $job->id,
            );
        }
        return view('frontend.jobs',compact('details'));
    }
    public function applyJob(Request $request){
        $id = $request->id;
        return view('frontend.applyjob',compact('id'));
    }
    public function applyJobSave(Request $request){
        $job = new Applyjob();
        $job->job_id = $request->job_id;
        $job->name = $request->name;
        $job->email = $request->email;
        $job->mobile = $request->mobile;
        $job->save();
        return redirect(route('frontend_apply_job',[$request->job_id]))->with('error','Job was successfully applied');
    }
}