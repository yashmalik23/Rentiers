<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\User;
use Hash;
use App\properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class userAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user != null){
            $id = $user->id;
            $props = DB::select('SELECT * from properties where user_id='.$id.' ORDER BY created_at DESC');
            return view('includes/useraccount')->with('props', $props);
        }else{
            return view('includes/login');
        }
    }

    public function showaccount($id)
    {
        $user = Auth::user();
        if($user != null){
            if($user->email == "admin@rentiers.in"){
                $props = DB::select('SELECT * from properties where user_id='.$id.' ORDER BY created_at DESC');
                return view('admin/includes/adminuseraccount')->with('props', $props);
            }
        }else{
            return view('includes/login');
        }
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
            return view('includes/view')
                    ->with('props', $props)
                    ->with('ameneties',$ameneties)
                    ->with('closeTo',$closeTo)
                    ->with('invchecks',$inventorychecks)
                    ->with('invcounts',$inventorycounts)
                    ->with('tenant',$tenant);
        }else{
            return view('includes/login');
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
            return view('includes/edit')
                        ->with('props', $props)
                        ->with('ameneties',$ameneties)
                        ->with('invchecks',$inventorychecks)
                        ->with('invcounts',$inventorycounts)
                        ->with('closeTo',$closeTo)
                        ->with('tenant',$tenant)
                        ->with('rooms', $rooms)
                        ->with('cities',$citie)
                        ->with('localities',$locality)
                        ->with('projects',$projects);
        }else{
            return view('includes/login');
        }
    }

    public function images($id){
        $images = explode(",",properties::find($id)->images);
        $prop = properties::find($id);
        $user = Auth::user();
        if($user != null){
            return view('includes/viewimages')->with('images',$images)->with('propid',$id)->with('prop',$prop);
        }else{
            return view('includes/login');
        }
    }

    public function changeOrder(Request $request){
        $id=$request->input('id');
        $num = intval($request->input('image'));
        $prop = properties::find($id);
        $images = explode(",",$prop->images);
        $val = $images[$num-1];
        $images[$num-1] = $images[0];
        $images[0] = $val;
        $prop->images = join(',',$images);
        $prop->save();
        return back()->with('order','done');
    }

    public function deleteimage(Request $request){
        $id=$request->input('id');
        $name= $request->input('image');
        $prop = properties::find($id);
        $images = explode(",",$prop->images);
        $string = "";
        for($i=0;$i<count($images);$i++){
            if($images[$i] != $name && $images[$i] != ""){
                $string = $string.$images[$i].",";
            }
        }
        if($string == ""){
            $string = "noimage.png,";
        }
        $prop->images = $string;
        $prop->save();
        Storage::delete('public/'.$id.'/'.$name);
        return back()->with('delete',"deleted");

    }

    public function password(){
        if(Auth::user()!=null){
            return view('includes/changedetails');
        }else{
            return redirect('login');
        }
    }

    public function changepassword(Request $request){
        if(Auth::user()){
                if($request->input('npassword') != $request->input('cpassword')){
                    return back()->with('error','password_dont_match');
                }else if(Hash::check($request->input('opassword'),Auth::user()->password)){
                    $admin = User::find(Auth::user()->id);
                    $admin->password = Hash::make($request->input('npassword'));
                    $admin->save();
                    return back()->with('success','Changed successfully');
                }
                return back()->with('error','wrong_current_password');
        }
        return redirect(route('login'))->with('timeout',"timed_out");
    }

    public function changedetails(Request $request){
        if(Auth::user()){
            if(Hash::check($request->input('opassword'),Auth::user()->password)){
                $admin = User::find(Auth::user()->id);
                $admin->email = $request->input('email');
                $admin->name = $request->input('name');
                $admin->contact = $request->input('contact');
                $admin->save();
                return back()->with('success','Changed successfully');
            }
            return back()->with('error','wrong_current_password');
        }else{
            return redirect(route('login'))->with('error','error');
        }
    }

    public function changestatus(Request $request){
        if (Auth::user() != null){
            $prop = properties::find($request->id);
            $prop->inUse = $request->use;
            $prop->save();
            return back()->with('succ', 'changed');
        }else{
            return redirect(route('login'))->with('error','error');
        }
    }
}

// <form class="detail-form-container" method="POST" action="{{ route('changedetails')}}">
//                 @csrf
//                 <h3>Change Details</h3>
//                 <input type="text" name="email" value="{{Auth::user()->email}}" required/>
//                 <input type="text" name="name" value="{{Auth::user()->name}}" required/>
//                 <input type="text" name="contact" value="{{Auth::user()->contact}}" required/>
//                 <input type="password" name="opassword" id="user_name" placeholder="Current password" required/><br>
//                 <button>Change</button>
//             </form>