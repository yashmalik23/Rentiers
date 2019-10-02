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

    public function normal(Request $request){
        $props = DB::table('properties')->paginate(5);
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Fully furnished", "Semi furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["Relevance","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        return view('includes/searchResults')->with('search',$request->input('search-text'))
                                            ->with('props',$props)
                                            ->with('sort',$sort)
                                            ->with('ameneties',$ameneties)
                                            ->with('cities',$citie)
                                            ->with('localities',$locality)
                                            ->with('projects',$projects)
                                            ->with('furnishing',$furnishing)
                                            ->with('configuration',$configuration)
                                            ->with('city',$request->input('city'))
                                            ->with('listedFor',$request->input('listedFor'))
                                            ->with('closeTo',$closeTo)
                                            ->with('budget','0_0')
                                            ->with('conf','000000')
                                            ->with('furn','000')
                                            ->with('amenety','000000000000000')
                                            ->with('close','0000000')
                                            ->with('sortBy','1000');
    }
    public function search(){
        $props = DB::table('properties')->paginate(5);
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Fully furnished", "Semi furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["Relevance","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        return view('includes/searchResults')->with('search',"")
                                            ->with('props',$props)
                                            ->with('sort',$sort)
                                            ->with('ameneties',$ameneties)
                                            ->with('furnishing',$furnishing)
                                            ->with('cities',$citie)
                                            ->with('localities',$locality)
                                            ->with('projects',$projects)
                                            ->with('configuration',$configuration)
                                            ->with('city','GURUGRAM')
                                            ->with('listedFor','RENT')
                                            ->with('closeTo',$closeTo)
                                            ->with('budget','0_0')
                                            ->with('conf','000000')
                                            ->with('furn','000')
                                            ->with('amenety','000000000000000')
                                            ->with('close','0000000')
                                            ->with('sortBy','1000');
    }

    public function filters(Request $request){
        $budget1 = explode($request->input('budget'))[0];
        $budget2 = explode($request->input('budget'))[1];
        $conf1 = (explode($request->input('configuration'))[0] == "1")?"1BHK":null;
        $conf2 = (explode($request->input('configuration'))[1] == "1")?"2BHK":null;
        $conf3 = (explode($request->input('configuration'))[2] == "1")?"3BHK":null;
        $conf4 = (explode($request->input('configuration'))[3] == "1")?"4BHK":null;
        $conf5 = (explode($request->input('configuration'))[4] == "1")?"5BHK":null;
        $conf6 = (explode($request->input('configuration'))[5] == "1")?">5BHK":null;
        $amenety = $request->input('ameneties');
        $closeto = $request->input('closeto');
        $f1 = $request->input('furnishing');
        $city = $request->input('city');
        $listedFor = $request->input('listedFor');
        $text = $request->input('search-text');
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Fully furnished", "Semi furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["Relevance","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        $props = DB::table('properties')->paginate(5);
        return back()->with('search',$text)
                    ->with('props',$props)
                    ->with('sort',$sort)
                    ->with('ameneties',$ameneties)
                    ->with('furnishing',$furnishing)
                    ->with('configuration',$configuration)
                    ->with('cities',$citie)
                    ->with('localities',$locality)
                    ->with('projects',$projects)
                    ->with('closeTo',$closeTo)
                    ->with('city',$city)
                    ->with('listedFor',$listedFor)
                    ->with('budget',$request->input('budget'))
                    ->with('conf',$request->input('configuration'))
                    ->with('furn',$request->input('furnishing'))
                    ->with('amenety',$request->input('ameneties'))
                    ->with('close',$request->input('closeto'))
                    ->with('sortBy',$request->input('sortBy'));
    }
}
