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


    //Sellers
    public function sellers(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $sellers = DB::table('users')->where('member','=','Seller')->paginate(12);
                return view('admin/includes/sellers')->with('sellers',$sellers)->with('search',"");
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
                $props = DB::select('SELECT * from properties where verified = 1');
                return view('admin/includes/vassets')->with('props', $props)->with('search',"");
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    //Unverified assets
    public function uassets(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = DB::select('SELECT * from properties where verified = 0');
                return view('admin/includes/uassets')->with('props', $props)->with('search',"");
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
            return view('admin/includes/login')->with('error','wrong_details');
        }
    }

    public function show($id){
        $user = Auth::user();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Chimney","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Wooden floor"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple"];
        if($user->id != null){
            $props = DB::select('SELECT * from properties where id='.$id);
            return view('admin/includes/adminview')->with('props', $props)->with('ameneties',$ameneties)->with('closeTo',$closeTo)->with('tenant',$tenant);
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
            return view('admin/includes/adminedit')->with('props', $props)->with('ameneties',$ameneties)->with('closeTo',$closeTo)->with('tenant',$tenant)->with('rooms', $rooms);
        }else{
            return view('includes/login');
        }
    }

    public function changever(Request $request){
        $id = $request->input('id');
        if(Auth::user()){
            if(Auth::user()->email=="inforentiers@gmail.com"){
                $prop = properties::find($id);
                $prop->verified = 1;
                $prop->save();
                return redirect(route('uassets'));
            }else{
                return redirect(route('adminlogin'));
            }
        }else{
            return redirect(route('adminlogin'));
        }
    }

    public function upropsearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = DB::select('SELECT * from `properties` where verified=0 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")');
                return view('admin/includes/uassets')->with('props', $props)->with('search',$text);
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }

    public function vpropsearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = DB::select('SELECT * from `properties` where verified=1 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")');
                return view('admin/includes/vassets')->with('props', $props)->with('search',$text);
            }else{
                return view('admin/includes/login');
            }
        }
        return view('admin/includes/login');
    }
    public function uaddimage(Request $request){
        
        $user = Auth::user();
        $id = $request->input('id');
        $props = properties::find($id);
        if($props->images == "noimage.png,"){
            $string = "";
        }else{
            $string = $props->images;
        }
        if($request->hasFile('file')){
            foreach ($request->file as $file){
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $nameToStore = $filename."_".time().".".$extension;
                $path = $file->storeAs("public/".$id, $nameToStore);   
                $string = $string.$nameToStore.","; 
            }
        }
        
        $props->images = $string;
        $props->save();

        return redirect(route('uassets'));
    }
    public function vaddimage(Request $request){
        
        $user = Auth::user();
        $id = $request->input('id');
        $props = properties::find($id);
        if($props->images == "noimage.png,"){
            $string = "";
        }else{
            $string = $props->images;
        }
        if($request->hasFile('file')){
            foreach ($request->file as $file){
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $nameToStore = $filename."_".time().".".$extension;
                $path = $file->storeAs("public/".$id, $nameToStore);   
                $string = $string.$nameToStore.","; 
            }
        }
        
        $props->images = $string;
        $props->save();
        return redirect(route('vassets'));
    }
}
