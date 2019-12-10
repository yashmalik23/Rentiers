<?php

namespace App\Http\Controllers;
use Auth;
use App\properties;
use App\User;
use App\requests;
use DB;
use Hash;
use Illuminate\Http\Request;

class checkauth{
    public $city;
    public $role;

    public function __construct(){
        if(Auth::user()!=null){
            $admin = DB::table('subadmins')->where('email','=',Auth::user()->email)->count();
            if($admin>0){
                $admin = DB::table('subadmins')->where('email','=',Auth::user()->email)->get();
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

class adminController extends Controller
{
    
    public function dashboard(){
        $user = new checkauth;
        if($user->role=="admin"){
            $members = DB::table('users')->where('member','=','Member')->count();
            $sellers = DB::table('users')->where('member','=','Seller')->count();
            $vassets = DB::table('properties')->where('verified','=','1')->count();
            $uassets = DB::table('properties')->where('verified','=','0')->count();
            $contacts = requests::count();
            return view('admin/includes/dashboard')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
        }else if($user->role == "subadmin"){
            $members = DB::table('users')->where('member','=','Member')->count();
            $sellers = DB::table('users')->where('member','=','Seller')->count();
            $vassets = DB::table('properties')->whereRaw('verified=1 AND city='.$user->city)->count();
            $uassets = DB::table('properties')->whereRaw('verified=0 AND city='.$user->city)->count();
            $contacts = requests::count();
            return view('admin/includes/dashboard')->with('members',$members)->with('sellers',$sellers)->with('vassets',$vassets)->with('uassets',$uassets)->with('contacts',$contacts);
        }        
    }

    //Members
    public function members(){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $members = DB::table('users')->where('member','=','Member')->paginate(12);
        return view('admin/includes/members')->with('members',$members)->with('search',"");
    }

    public function membersearch($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $members = DB::table('users')->where('member','=','Member')->where('name','like','%'.$text.'%')->paginate(12);
        return view('admin/includes/members')->with('members',$members)->with('search',$text);
    }

    public function memberdelete(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $id = $request->input('id');
        $member = User::find($id);
        $member->delete();
        $props = DB::table('properties')->where('user_id','=',$id);
        $props->delete();
        $members = DB::table('users')->where('member','=','Member')->paginate(12);
        return view('admin/includes/members')->with('members',$members)->with('search',"")->with('delete',"deleted");
    }


    //Sellers
    public function sellers(){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $sellers = DB::table('users')->where('member','=','Seller')->paginate(12);
        return view('admin/includes/sellers')->with('sellers',$sellers)->with('search',"");
    }
    
    public function sellersearch($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $members = DB::table('users')->where('member','=','Seller')->where('name','like','%'.$text.'%')->paginate(12);
        return view('admin/includes/sellers')->with('sellers',$members)->with('search',$text);
 
    }

    public function sellerdelete(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $id = $request->input('id');
        $member = User::find($id);
        $member->delete();
        $props = DB::table('properties')->where('user_id','=',$id);
        $props->delete();
        $members = DB::table('users')->where('member','=','Seller')->paginate(12);
        return view('admin/includes/sellers')->with('sellers',$members)->with('search',"")->with('delete',"deleted");
    }
    
    public function vassets(){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        if($user->role=="admin"){
            $props = DB::table('properties')->where('verified','=',1)->orderBy('created_at', 'DESC')->paginate(12);
            return view('admin/includes/vassets')->with('props', $props)->with('search',"");
        }else{
            $props = DB::table('properties')->whereRaw('verified=1 AND city='.$user->city)->orderBy('created_at', 'DESC')->paginate(12);
            return view('admin/includes/vassets')->with('props', $props)->with('search',"");
        }
    }

    //Unverified assets
    public function uassets(){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        if($user->role=="admin"){
            $props = DB::table('properties')->where('verified','=',0)->orderBy('created_at', 'DESC')->paginate(12);
            return view('admin/includes/uassets')->with('props', $props)->with('search',"");
        }else{
            $props = DB::table('properties')->whereRaw('verified=0 AND city='.$user->city)->paginate(12);
            return view('admin/includes/uassets')->with('props', $props)->with('search',"");
        }
    }

    public function requests(){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $requests = DB::table('requests')->paginate(12);
        return view('admin/includes/requests')->with('requests', $requests)->with('search',"");
    }
    public function requestsearch($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $requests = DB::table('requests')->whereRaw('status like "%'.$text.'%" OR contact like "%'.$text.'%"')->paginate(12);
        return view('admin/includes/requests')->with('requests', $requests)->with('search',$text);
    }
    public function requestdelete(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        requests::find($request->input('id'))->delete();
        return back()->with('delete',"deleted");
    }
    public function requeststatus(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $req = requests::find($request->input('id'));
        $req->status = $request->input('requeststatus');
        $req->updated_at = time();
        $req->save();
        return back()->with('status','status');
    }

    public function changepassword(Request $request){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        if($request->input('npassword') != $request->input('cpassword')){
            return back()->with('error','password_dont_match');
        }else if(Hash::check($request->input('opassword'),Auth::user()->password)){
            $admin = User::find(1);
            $admin->password = Hash::make($request->input('npassword'));
            $admin->save();
            return back()->with('success','Changed successfully');
        }
        return back()->with('error','wrong_current_password');
    }

    public function show($id){
        $user = Auth::user();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $inventorychecks = ["Modular Kitchen","Fridge","Stove","Washing Machine","Water purifier","Curtains","Microwave","Chimney","Dining Table"];
        $inventorycounts = ["Beds","Lights","Fans","ACs","Geysers","TVs","Wardrobes","Exhausts","Sofas"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","Unmarried Couple","Company Lease"];
        if($user->id != null){
            $props = DB::select('SELECT * from properties where id='.$id);
            $interests = DB::select('SELECT * from interests where prop_id='.$id);
            return view('admin/includes/adminview')
                    ->with('interests', $interests)
                    ->with('props', $props)
                    ->with('ameneties',$ameneties)
                    ->with('invchecks',$inventorychecks)
                    ->with('invcounts',$inventorycounts)
                    ->with('closeTo',$closeTo)
                    ->with('tenant',$tenant);
        }else{
            return redirect(route('adminlogin'))->with('timeout',"timed_out");
        }
    }

    public function edit($id){
        $user = Auth::user();
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $rooms = ["Pooja Room","Servant Room","Study Room"];
        $inventorychecks = ["Modular Kitchen","Fridge","Stove","Washing Machine","Water purifier","Curtains","Microwave","Chimney","Dining Table"];
        $inventorycounts = ["Beds","Lights","Fans","ACs","Geysers","TVs","Wardrobes","Exhausts","Sofas"];
        $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple","Company Lease"];
        if($user->id != null){
            $citie = explode(",",DB::table('suggestions')->find(1)->cities);
            $locality = DB::table('suggestions')->find(1)->localities;
            $projects = DB::table('suggestions')->find(1)->projectNames;
            $props = DB::select('SELECT * from properties where id='.$id);
            return view('admin/includes/adminedit')
                    ->with('props', $props)
                    ->with('ameneties',$ameneties)
                    ->with('closeTo',$closeTo)
                    ->with('invchecks',$inventorychecks)
                    ->with('invcounts',$inventorycounts)
                    ->with('tenant',$tenant)
                    ->with('rooms', $rooms)
                    ->with('cities',$citie)
                    ->with('localities',$locality)
                    ->with('projects',$projects);
        }else{
            return redirect(route('adminlogin'))->with('timeout',"timed_out");
        }
    }

    public function changever(Request $request){
        $id = $request->input('id');
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        $prop = properties::find($id);
        $prop->verified = 1;
        $prop->save();
        return redirect(route('uassets'))->with('success','success');
    }

    public function upropsearch($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        if($user->role == "admin"){
            $props = properties::whereRaw('verified=0 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
            return view('admin/includes/uassets')->with('props', $props)->with('search',$text);
        }else{
            $props = properties::whereRaw('verified=0 AND city='.$user->city.' AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
            return view('admin/includes/uassets')->with('props', $props)->with('search',$text);
        }
    }

    public function vpropsearch($text){
        $user = new checkauth;
        if($user->role != "admin" && $user->role != "subadmin"){return redirect(route('adminlogin'))->with('error','not admin or subadmin');}
        if($user->role == "admin"){
            $props = properties::whereRaw('verified=1 AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
            return view('admin/includes/vassets')->with('props', $props)->with('search',$text);
        }else{
            $props = properties::whereRaw('verified=1 AND city='.$user->city.' AND (`houseNo` like "%'.$text.'%" OR `streetName` like "%'.$text.'%" OR `city` like "%'.$text.'%" OR `locality` like "%'.$text.'%" OR `nearByArea` like "%'.$text.'%")')->paginate(12);
            return view('admin/includes/vassets')->with('props', $props)->with('search',$text);
        }
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
