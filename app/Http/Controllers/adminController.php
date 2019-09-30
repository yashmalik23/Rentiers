<?php

namespace App\Http\Controllers;
use Auth;
use App\properties;
use App\User;
use App\requests;
use DB;
use Hash;
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
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }

    public function membersearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Member')->where('name','like',$text)->paginate(12);
                return view('admin/includes/members')->with('members',$members)->with('search',$text);
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
                return view('admin/includes/members')->with('members',$members)->with('search',"")->with('delete',"deleted");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }


    //Sellers
    public function sellers(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $sellers = DB::table('users')->where('member','=','Seller')->paginate(12);
                return view('admin/includes/sellers')->with('sellers',$sellers)->with('search',"");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }
    
    public function sellersearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $members = DB::table('users')->where('member','=','Seller')->where('name','like',$text)->paginate(12);
                return view('admin/includes/sellers')->with('sellers',$members)->with('search',$text);
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
                return view('admin/includes/sellers')->with('sellers',$members)->with('search',"")->with('delete',"deleted");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }
    
    public function vassets(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = DB::table('properties')->where('verified','=',1)->paginate(12);
                return view('admin/includes/vassets')->with('props', $props)->with('search',"");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }

    //Unverified assets
    public function uassets(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = DB::table('properties')->where('verified','=',0)->paginate(12);
                return view('admin/includes/uassets')->with('props', $props)->with('search',"");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }

    public function requests(){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $requests = DB::table('requests')->paginate(12);
                return view('admin/includes/requests')->with('requests', $requests)->with('search',"");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }
    public function requestsearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $requests = DB::table('requests')->whereRaw('status like "%'.$text.'%" OR contact like "%'.$text.'%"')->paginate(12);
                return view('admin/includes/requests')->with('requests', $requests)->with('search',$text);
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }
    public function requestdelete(Request $request){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                requests::find($request->input($id))->delete();
                return back()->with('delete',"deleted");
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }
    public function requeststatus(Request $request){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $req = requests::find($request->input('id'));
                $req->status = $request->input('requeststatus');
                $req->updated_at = time();
                $req->save();
                return back()->with('status','status');
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
                return view('admin/includes/dashboard')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
            }else{
                return view('admin/includes/login')->with('error','wrong_details');
            }
        }else{
            return view('admin/includes/login')->with('error','wrong_details');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('adminlogin'));
    }

    public function changepassword(Request $request){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                if($request->input('npassword') != $request->input('cpassword')){
                    return back()->with('error','password_dont_match');
                }else if(Hash::check($request->input('opassword'),Auth::user()->password)){
                    $admin = User::find(1);
                    $admin->password = Hash::make($request->input('npassword'));
                    $admin->save();
                    return back()->with('success','Changed successfully');
                }
                return back()->with('error','wrong_current_password');
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
            return redirect(route('adminlogin'))->with('timeout',"timed_out");
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
            return redirect(route('adminlogin'))->with('timeout',"timed_out");
        }
    }

    public function changever(Request $request){
        $id = $request->input('id');
        if(Auth::user()){
            if(Auth::user()->email=="inforentiers@gmail.com"){
                $prop = properties::find($id);
                $prop->verified = 1;
                $prop->save();
                return redirect(route('uassets'))->with('success','success');
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }else{
            return redirect(route('adminlogin'))->with('timeout',"timed_out");
        }
    }

    public function upropsearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = properties::whereRaw('verified=0 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
                return view('admin/includes/uassets')->with('props', $props)->with('search',$text);
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
    }

    public function vpropsearch($text){
        if(Auth::user()){
            if(Auth::user()->email == 'inforentiers@gmail.com'){
                $props = properties::whereRaw(' verified=1 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
                return view('admin/includes/vassets')->with('props', $props)->with('search',$text);
            }else{
                return redirect(route('adminlogin'))->with('timeout',"timed_out");
            }
        }
        return redirect(route('adminlogin'))->with('timeout',"timed_out");
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

        return redirect(route('uassets'))->with('image','image');
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
        return redirect(route('vassets'))->with('image','image');
    }
}
