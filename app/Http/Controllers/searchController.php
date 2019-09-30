<?php

namespace App\Http\Controllers;
use App\properties;
use DB;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function show($id){
        $props = DB::table('properties')->where('id','=',$id)->get();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple","Company Lease"];
        return view('includes/userview')->with('props', $props)->with('ameneties',$ameneties)->with('closeTo',$closeTo)->with('tenant',$tenant);
    }
}
