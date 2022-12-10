<?php

namespace App\Http\Controllers\Clinic;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\ClinicFile;
use App\Models\ClinicSlot;
use App\Models\ClinicVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Clinic as ModelsClinic;
use App\Models\Provider as ModelsProvider;

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
            $user->profile  = $file;
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
    public function addServiceSave(Request $request){
        $service = new Service();
        $service->clinic_id = $request->userid;
        $service->service = $request->service;
        $service->save();
        toast('Sucess Saved.', 'success')->autoClose(3000);
        return redirect(route('addService'));
    }
    public function addService(){
        $details = Service::where('clinic_id',session('userid'))->get();
        return view('clinic.addservice',compact('details'));
    }
}
