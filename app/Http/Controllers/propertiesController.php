<?php

namespace App\Http\Controllers;
use App\properties;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
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

class propertiesController extends Controller
{
    private $key = "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";
    
    public function index()
    {   
        if(Auth::user() != null){
            $citie = explode(",",DB::table('suggestions')->find(1)->cities);
            $locality = DB::table('suggestions')->find(1)->localities;
            $projects = DB::table('suggestions')->find(1)->projectNames;
            return view('includes/list')
                    ->with('cities',$citie)
                    ->with('localities',$locality)
                    ->with('projects',$projects);   
        }else{
            return redirect(route('login'))->with('message','login to continue');
        }
    }

    public function all(){
        $props = DB::table('projects')->get();
        return view('includes/viewallprojects')->with('props',$props);
    }

    public function showProject($id){
        $user = Auth::user();
        if(Auth::user() != null){
            if($user->email != "admin@rentiers.in"){
                $data = ['message' => $user->name.', '.$user->contact.', '.$user->email.' has visited project number '.$id ];
                $email = new \SendGrid\Mail\Mail(); 
                $email->setFrom("rentiersalerts@gmail.com", "Rentiers Gurgaon");
                $email->setSubject($user->name.', '.$user->contact." visited this project today!");
                $email->addTo("rentiersalerts@gmail.com", "Rentiers Gurgaon");
                $email->addContent("text/plain", $data['message']);
                $sendgrid = new \SendGrid($this->key);
                $response = $sendgrid->send($email);
            }
            $project = DB::table('projects')->find($id);
            $proj = [];
            for($i =0 ;$i<count(explode(',',$project->suggest));$i++){
                $temp = DB::table('projects')->find(explode(',',$project->suggest)[$i]);
                array_push($proj,$temp);
            }

            $amen = ["Air conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","24*7 power backup","Wheelchair friendly","Gated Society","24*7 water","Mini theatre"];
            return view('includes/projectview')->with('project',$project)->with('amen',$amen)->with('sugg',$proj);
        }else{
            return redirect(route('login'))->with('message','login to continue');
        }

    }
    
    public function store(Request $request)
    {
        $props = new properties;
        $props->postedBy = $request->input('postedBy');
        $props->listedFor = $request->input('listedFor');
        $props->propertyType = $request->input('propertyType');
        $props->propertySecondType = $request->input('propertySecondType');
        $props->propertyThirdType = $request->input('propertyThirdType');
        $props->multipleUnits = $request->input('multipleUnits');
        $props->houseNo = $request->input('houseNo');
        $props->streetName = $request->input('streetName');
        $props->nearByArea = $request->input('nearByArea');
        $props->locality = $request->input('locality');
        $props->city = $request->input('city');
        $props->configuration = $request->input('configuration');
        $props->area = $request->input('area');
        $props->bathRooms = $request->input('bathRooms');
        $props->balconies = $request->input('balconies');
        $props->rooms = $request->input('rooms');
        $props->furnishing = $request->input('furnishing');
        $props->parking = $request->input('parking');
        $props->ageOfProperty = $request->input('ageOfProperty');
        $props->floor = $request->input('floor');
        $props->totalFloors = $request->input('totalFloors');
        $props->availableFrom = $request->input('availableFrom');
        $props->availability = $request->input('availabilty');
        $props->contract = $request->input('contract');
        $props->expectedPrice = $request->input('expectedPrice');
        $props->includeTaxes = "Yes";
        $props->otherCharges = $request->input('otherCharges');
        $props->ameneties = $request->input('ameneties');
        $props->tenant = $request->input('tenant');
        $props->closeTo = $request->input('closeTo');
        $props->inUse = $request->input('inUse');
        $props->images = "noimage.png,";
        $props->verified = 0;
        $props->ownerdetails = $request->input('ownerDetails');
        $props->intmembers=0;
        $props->invchecks = $request->input('invchecks');
        $props->invcounts = $request->input('invcounts');
        $user = Auth::user();
        if($user){
            $props->user_id = $user->id;
            $props->save();
            return redirect(route('useraccount'))->with('property','added_successfully');
        }else{
            $props->save();
            return view('includes/login');
        }

    }

    public function update(Request $request){
        $props = properties::find($request->input('id'));
        $props->houseNo = $request->input('houseNo');
        $props->streetName = $request->input('streetName');
        $props->nearByArea = $request->input('nearByArea');
        $props->locality = $request->input('locality');
        $props->city = $request->input('city');
        $props->configuration = $request->input('configuration');
        $props->area = $request->input('area');
        $props->bathRooms = $request->input('bathRooms');
        $props->balconies = $request->input('balconies');
        $props->rooms = $request->input('rooms');
        $props->furnishing = $request->input('furnishing');
        $props->parking = $request->input('parking');
        $props->ageOfProperty = $request->input('ageOfProperty');
        $props->floor = $request->input('floor');
        $props->totalFloors = $request->input('totalFloors');
        $props->availableFrom = $request->input('availableFrom');
        $props->availability = $request->input('availabilty');
        $props->contract = $request->input('contract');
        $props->expectedPrice = $request->input('expectedPrice');
        $props->includeTaxes = "Yes";
        $props->otherCharges = $request->input('otherCharges');
        $props->ameneties = $request->input('ameneties');
        $props->tenant = $request->input('tenant');
        $props->closeTo = $request->input('closeTo');
        $props->inUse = $request->input('inUse');
        $props->verified = 0;
        $props->ownerdetails = $request->input('ownerDetails');
        $props->intmembers=0;
        $props->invchecks = $request->input('invchecks');
        $props->invcounts = $request->input('invcounts');
        $user = Auth::user();
        if($user){
            $admin = new checkauth;
            if($admin->role!="admin" && $admin->role!="subadmin"){
                $props->user_id = $user->id;
            }
        }
        $props->save();   
        return back()->with('property',$request->input('area'));
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $props = properties::find($id);
        $user = Auth::user();
        $images = explode(",",$props->images);
        for($i = 0;$i <count($images);$i++){
            if($images[$i] != "noimage.png"){
                Storage::delete('public/'.$id."/".$images[$i]);
            }
        }
        $props->delete();
        $id = $user->id;
        $props = DB::select('SELECT * from properties where user_id='.$id);
        return back()->with('delete',"deleted successfully")->with('props', $props);
    }

    // Compress image
    public static function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

    }


    public function addimage(Request $request){
        $user = Auth::user();
        $id = $request->input('id');
        $props = properties::find($id);
        $dir = 'storage/'.$id;
        if ( is_dir($dir) == false){
            mkdir($dir);
        }
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
                $location = "storage/".$id."/".$nameToStore;
                self::compressImage($file,$location,50);
                $string = $string.$nameToStore.","; 
            }
        }
        
        $props->images = $string;
        $props->save();

        $id = $user->id;
        $props = DB::select('SELECT * from properties where user_id='.$id);
        return back()->with('image','added');
    }
}
