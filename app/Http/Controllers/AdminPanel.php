<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    public function dashboard(Request $request){
        return view('panel.dashboard');
    }
    public function users(Request $request){
        $data = User::paginate(1);
        return view('panel.users',compact($data,'data'));
    }
    public function profile(Request $request, $id){
        $user = User::find($id);
        return view('panel.profile',compact($user,'user'));
    }
}