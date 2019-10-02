<?php

namespace App\Http\Controllers;
use Auth;
use App\properties;
use App\User;
use App\requests;
use DB;
use Hash;

use Illuminate\Http\Request;

class adminloginController extends Controller
{   
    public $city = "";
    public $role = "";
    public function login(Request $request){

        $user_data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::attempt($user_data)){
            $admin = DB::table('subadmins')->where('email','=',Auth::user()->email)->get();
            if(count($admin)>0){
                foreach($admin as $admi){
                    $this->city = $admi->city;
                    $this->role = $admi->role;
                    if($this->role=="admin"){
                        $members = DB::table('users')->where('member','=','Member')->count();
                        $sellers = DB::table('users')->where('member','=','Seller')->count();
                        $vassets = DB::table('properties')->where('verified','=','1')->count();
                        $uassets = DB::table('properties')->where('verified','=','0')->count();
                        $contacts = requests::count();
                        return view('admin/includes/dashboard')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
                    }else{
                        $members = DB::table('users')->where('member','=','Member')->count();
                        $sellers = DB::table('users')->where('member','=','Seller')->count();
                        $vassets = DB::table('properties')->whereRaw('verified=1 AND city='.$this->city)->count();
                        $uassets = DB::table('properties')->whereRaw('verified=0 AND city='.$this->city)->count();
                        $contacts = requests::count();
                        return view('admin/includes/dashboard')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
                    }
                }
            }else{
                Auth::logout();
                return redirect(route('adminlogin'))->with('error','Not an admin or subadmin');
            }
        }else{
            return view('admin/includes/login')->with('error','wrong_details');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('adminlogin'));
    }
    
    public function index(){
        return view('admin/includes/login');
    }
}
