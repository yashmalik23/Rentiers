<?php

namespace App\Http\Controllers;
use App\interests;
use App\properties;
use DB;
use Auth;
use Illuminate\Http\Request;


class checkauth{
    public $city;
    public $role;

    public function __construct(){
        if(Auth::user()!=null){
            $admin = DB::table('subadmins')->where('email','=',Auth::user()->email)->get();
            if(count($admin)>0){
                foreach($admin as $admi){
                    $this->city= $admi->city;
                    $this->role= $admi->role;
                }
            }else{
                Auth::logout();
                return view('admin/includes/login')->with('error','Not an admin or subadmin');
            }
        }else{
            return view('admin/includes/login')->with('error','login_to_continue');
        }
    }
}

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
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $interests = DB::table('interests')->paginate(12);
        return view('admin/includes/interests')->with('interests',$interests)->with('search','');
    }

    public function delete(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $int = interests::find($request->input('id'));
        $int->delete();
        return back()->with('delete','deleted');
    }

    public function search($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $interests = DB::table('interests')->whereRaw('propdetails like "%'.$text.'%" OR name like "%'.$text.'%"')->paginate(12);
        return view('admin/includes/interests')->with('interests',$interests)->with('search',$text);
    }
}
