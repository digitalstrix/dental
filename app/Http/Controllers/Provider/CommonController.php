<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Clinic as ModelsClinic;
use App\Models\Provider as ModelsProvider;
use App\Models\Providersfile;
use App\Models\ProvidersSlot;
use App\Models\ProviderVisit;
use App\Models\User;
use Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $user = ModelsProvider::find($userid);
        return view('providers.profile',compact($user,'user'));
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
        $user->about = $request->about;
        $user->url = $request->url;
        if($request->hasFile('image')){
           $file = $request->file('image')->store('public/img/provider/profile');
           $user->profile = $file;
       }
        if($request->hasFile('banner')){
           $file = $request->file('banner')->store('public/img/provider/banner');
           $user->banner = $file;
       }
       $result = $user->save();
       toast('User Updated Successfully','success')->autoClose(3000);
       return view('providers.profile',compact($user,'user'))->with('success','User Updated Sucessfully');
    }
    public function userCalendar(){
        return view('providers.calendar')->with('info', 'Users Meetings');
    }
    public function providersSlot(){
        $details = ProvidersSlot::where('providers_id',session('userid'))->get();
        return view('providers.providerslots',compact('details'))->with('info','Meetings Slots');
    }
    public function providersSlotSave(Request $request){
        $request->validate(
            [
                "userid" => "required",
                "start" => "required",
                "end" => "required",
            ]
        );
        $slot = new ProvidersSlot();
        $slot->providers_id = $request->userid;
        $slot->start = $request->start;
        $slot->end = $request->end;
        $slot->save();
        toast('Slot Saved Successfully','success')->autoClose(3000);
        $details = ProvidersSlot::where('providers_id',session('userid'))->get();
        return view('providers.providerslots',compact('details'))->with('info','Meetings Slots');
    }
    public function providersSlotDelete(Request $request){
        $slot = ProvidersSlot::where('id',$request->id)->delete();
        toast('Deleted Sucessfully','success')->autoClose(3000);
        $details = ProvidersSlot::where('providers_id',session('userid'))->get();
        return view('providers.providerslots',compact('details'))->with('info','Meetings Slots');
    }
    public function providersFile(){
            $userid = session('userid');
            $details = [];
            $temp1 = ModelsProvider::find($userid);
            $providersfile = Providersfile::where('provider_id',$temp1->id)->get();
            foreach( $providersfile as $file){
            $user = User::where('id', $file->user_id)->first();
                $details[] = array(
                    'provider_name' => $user->name,
                    'provider_id' => $user->id,
                    'file_name' => $file->file_name,
                    'file_url' => $file->file,
                    'file_id' => $file->id,
                );
        }
    return view('providers.userfile',compact('details'));
}
    public function providersMap()
    {
        $userid = session('userid');
        $details = [];
        $user = ModelsProvider::find($userid);
        $lat = $user->latitude;
        $lon = $user->longitude;
        $clinic = ModelsClinic::select(
            "*"
        , DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(clinics.latitude)) 
        * cos(radians(clinics.longitude) - radians(" . $lon . ")) 
        + sin(radians(" . $lat . ")) 
        * sin(radians(clinics.latitude))) AS distance")
        )->whereNotNull('latitude')->whereNotNull('longitude')
            ->get();
            $visit = ProviderVisit::where('providers_id', $userid)->get();
            foreach($visit as $visit){
                $temp = ModelsClinic::select(
                    "*"
                , DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                * cos(radians(clinics.latitude)) 
                * cos(radians(clinics.longitude) - radians(" . $lon . ")) 
                + sin(radians(" . $lat . ")) 
                * sin(radians(clinics.latitude))) AS distance")
                )->whereNotNull('latitude')->whereNotNull('longitude')->where('id',$visit->clinic_id)->orderBy('distance')
                    ->get();    
            // dd($temp[0]['id']);
            $details[] = array(
                'id' => $temp[0]['id'],
                'name' => $temp[0]['name'],
                'distance' => $temp[0]['distance'],
            );
            }
        return view('providers.providersmap', compact('clinic','details'));
    }
    public function providersMapSave(Request $request)
    {
        $userid = session('userid');
        if(ProviderVisit::where('providers_id', $userid)->where('clinic_id',$request->clinic)->first()){
            toast('Already You Opted for this Clinic Visit.','error')->autoClose(3000);
            return redirect(route('providersMap'));
        }
        $new = new ProviderVisit();
        $new->clinic_id = $request->clinic;
        $new->providers_id = $userid;
        $new->save();
        toast('Successfully Opted for Clinic Visit.','success')->autoClose(3000);
        return redirect(route('providersMap'));
    }
    public function providersMapDelete(Request $request)
    {
        $userid = session('userid');
        $visit = ProviderVisit::where('id',$request->id)->delete();
        toast('Sucess Delete.','success')->autoClose(3000);
        return redirect(route('providersMap'));
    }
}