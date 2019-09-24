<?php

namespace App\Http\Controllers;
use App\properties;
use Illuminate\Http\Request;

class propertiesController extends Controller
{
    //
    public function index()
    {
        return view('includes/list');
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
        $props->save();

        return redirect('listproperties')->with('property','added_successfully');
    }
}
