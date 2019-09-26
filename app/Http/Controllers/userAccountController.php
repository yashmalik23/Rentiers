<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\users;
use App\properties;
use Illuminate\Http\Request;

class userAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->id != null){
            $id = $user->id;
            $props = DB::select('SELECT * from properties where user_id='.$id);
            return view('includes/useraccount')->with('props', $props);
        }else{
            return view('includes/login');
        }
    }

    public function show($id){
        $user = Auth::user();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple"];
        if($user->id != null){
            $props = DB::select('SELECT * from properties where id='.$id);
            return view('includes/view')->with('props', $props)->with('ameneties',$ameneties)->with('closeTo',$closeTo)->with('tenant',$tenant);
        }else{
            return view('includes/login');
        }
    }

    public function edit($id){
        $user = Auth::user();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $rooms = ["Pooja Room","Servant Room","Study Room"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple"];
        if($user->id != null){
            $props = DB::select('SELECT * from properties where id='.$id);
            return view('includes/edit')->with('props', $props)->with('ameneties',$ameneties)->with('closeTo',$closeTo)->with('tenant',$tenant)->with('rooms', $rooms);
        }else{
            return view('includes/login');
        }
    }
}
