<?php

namespace App\Http\Controllers;
use Auth;
use App\properties;
use App\User;
use App\requests;
use DB;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin/includes/login');
    }

    //Members
    public function members(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Member')->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',"");
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function membersearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Member')->where('name','like',$text)->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',$text);
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function memberdelete(Request $request){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $id = $request->input('id');
                $member = User::find($id);
                $member->delete();
                $props = DB::table('properties')->where('user_id','=',$id);
                $props->delete();
                $members = DB::table('users')->where('member','=','Member')->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',"");
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function sellers(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                return view('admin/includes/sellers');
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }
    
    public function sellersearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Seller')->where('name','like',$text)->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',$text);
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function sellerdelete(Request $request){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $id = $request->input('id');
                $member = User::find($id);
                $member->delete();
                $props = DB::table('properties')->where('user_id','=',$id);
                $props->delete();
                $members = DB::table('users')->where('member','=','Seller')->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',"");
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }
    public function vassets(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                return view('admin/includes/vassets');
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }
    public function uassets(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                return view('admin/includes/uassets');
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function requests(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                return view('admin/includes/requests');
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }
    public function dashboard(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Member')->count();
                $sellers = DB::table('users')->where('member','=','Seller')->count();
                $vassets = DB::table('properties')->where('verified','=','1')->count();
                $uassets = DB::table('properties')->where('verified','=','0')->count();
                $contacts = requests::count();
                return view('admin/includes/dashboard')->with('success','logged_in')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function login(Request $request){

        $user_data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::attempt($user_data)){
            if($request->input('email') == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Member')->count();
                $sellers = DB::table('users')->where('member','=','Seller')->count();
                $vassets = DB::table('properties')->where('verified','=','1')->count();
                $uassets = DB::table('properties')->where('verified','=','0')->count();
                $contacts = requests::count();
                return view('admin/includes/dashboard')->with('success','logged_in')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
            }else{
                return view('admin/includes/login')->with('error','wrong_details');
            }
        }else{
            return redirect('admin/includes/login')->with('error','wrong_details');
        }
    }
}
