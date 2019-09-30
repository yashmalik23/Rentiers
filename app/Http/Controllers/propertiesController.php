<?php

namespace App\Http\Controllers;
use App\properties;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class propertiesController extends Controller
{
    //
    public function index()
    {   
        if(Auth::user()!=null){
            return view('includes/list');
        }else{
            return redirect(route('login'))->with('message','login');
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
        $user = Auth::user();
        if($user){
            $props->user_id = $user->id;
            $props->save();
            return back()->with('property','added_successfully');
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
        $user = Auth::user();
        if($user){
            if($user->email != "inforentiers@gmail.com"){
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

    public function addimage(Request $request){
        
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

        $id = $user->id;
        $props = DB::select('SELECT * from properties where user_id='.$id);
        return back()->with('image',"added");
    }
}
