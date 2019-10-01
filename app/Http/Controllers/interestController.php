<?php

namespace App\Http\Controllers;
use App\interests;
use App\properties;
use DB;
use Auth;
use Illuminate\Http\Request;

class interestController extends Controller
{
    public function store(Request $request){
        $int = new interests;
        $int->name = $request->input('name');
        $int->contact = $request->input('contact');
        $int->prop_id = $request->input('propid');
        $int->propdetails = $request->input('propdetails');
        $int->save();
        $prop = properties::find($request->input('propid'));
        if($prop->intmembers == "" || $prop->intmembers == null){
            $prop->intmembers = 0;
        }else{
            $prop->intmembers +=1;
        }
        $prop->save();
        return back()->with('success',"Interest shown successfully");
    }

    public function show(){
        if(Auth::user()!= null){
            if(Auth::user()->email == "inforentiers@gmail.com"){
                $interests = DB::table('interests')->paginate(12);
                return view('admin/includes/interests')->with('interests',$interests)->with('search','');
            }else{
                return redirect(route('adminlogin'));
            }
        }
        return redirect(route('adminlogin'));
    }

    public function delete(Request $request){
        if(Auth::user()!= null){
            if(Auth::user()->email == "inforentiers@gmail.com"){
                $int = interests::find($request->input('id'));
                $int->delete();
                // $interests = interests::all()->paginate(12);
                return back()->with('delete','deleted');
            }else{
                return redirect(route('adminlogin'));
            }
        }
        return redirect(route('adminlogin'));
    }

    public function search($text){
        if(Auth::user()!= null){
            if(Auth::user()->email == "inforentiers@gmail.com"){
                $interests = DB::table('interests')->whereRaw('propdetails like "%'.$text.'%" OR name like "%'.$text.'%"')->paginate(12);
                return view('admin/includes/interests')->with('interests',$interests)->with('search',$text);
            }else{
                return redirect(route('adminlogin'));
            }
        }
        return redirect(route('adminlogin'));
    }
}
