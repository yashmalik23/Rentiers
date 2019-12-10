<?php

namespace App\Http\Controllers;
use App\properties;
use DB;
use Illuminate\Http\Request;
use Auth;
use vendor\autoload;


use App\Mail\TestEmail;


class searchController extends Controller
{
    private $key = "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";

    public function show($id){
        $user = Auth::user();
        if($user != null){
            $props = DB::table('properties')->where('id','=',$id)->get();
            $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
            $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
            $inventorychecks = ["Modular Kitchen","Fridge","Stove","Washing Machine","Water purifier","Curtains","Microwave","Chimney","Dining Table"];
            $inventorycounts = ["Beds","Lights","Fans","ACs","Geysers","TVs","Wardrobes","Exhausts","Sofas"];
            $tenant = ["Family","Employed (Salaried)","Self-employed","Bachelors(Boys)","Bachelorette(Girls)","Married Couple","unmarried Couple","Company Lease"];
            
            if($user->email != "admin@rentiers.in"){
                $data = ['message' => $user->name.', '.$user->contact.', '.$user->email.' has visited property number '.$id.' having details House No '.$props[0]->houseNo.' and location '.$props[0]->streetName ];
                $email = new \SendGrid\Mail\Mail(); 
                $email->setFrom("rentiersalerts@gmail.com", "Rentiers Gurgaon");
                $email->setSubject($user->name.', '.$user->contact." visited this property today!");
                $email->addTo("rentiersalerts@gmail.com", "Rentiers Gurgaon");
                $email->addContent("text/plain", $data['message']);
                $sendgrid = new \SendGrid($this->key);
                $response = $sendgrid->send($email);
            }

            return view('includes/userview')
                    ->with('props', $props)
                    ->with('ameneties',$ameneties)
                    ->with('closeTo',$closeTo)
                    ->with('invchecks',$inventorychecks)
                    ->with('invcounts',$inventorycounts)
                    ->with('tenant',$tenant);

        }else{
            return redirect(route('login'))->with('message','login to continue');
        }
    }

    public function normal(){
        $text = $_GET['search-text'];
        $city = $_GET['city'];
        $listedFor = $_GET['listedFor'];
        $searchListedFor = ($listedFor == "RENT")? "Rent":"Sell";
        $allprops = DB::table('properties')
                            ->where('city','=',$city)
                            ->where('listedFor','=',$searchListedFor);
        $props1 = DB::table('properties')
                        ->where('city','=',$city)
                        ->where('listedFor','=',$searchListedFor)
                        ->where('locality','like','%'.$text.'%');
        $props2 = DB::table('properties')
                        ->where('city','=',$city)
                        ->where('listedFor','=',$searchListedFor)
                        ->where('streetName','like','%'.$text.'%');
        $props = $props1->union($props2)
                        ->union($allprops)
                        ->paginate(8);
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Semi furnished", "Fully furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["By search text","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        return view('includes/searchResults')->with('search',$text)
                                            ->with('props',$props)
                                            ->with('sort',$sort)
                                            ->with('ameneties',$ameneties)
                                            ->with('cities',$citie)
                                            ->with('localities',$locality)
                                            ->with('projects',$projects)
                                            ->with('furnishing',$furnishing)
                                            ->with('configuration',$configuration)
                                            ->with('city',$_GET['city'])
                                            ->with('listedFor',$_GET['listedFor'])
                                            ->with('closeTo',$closeTo)
                                            ->with('budget','0_0')
                                            ->with('conf','000000')
                                            ->with('furn','000')
                                            ->with('amenety','0000000000000')
                                            ->with('close','0000000')
                                            ->with('sortBy','1000');
    }
    public function search(){
        $props = DB::table('properties')->paginate(8);
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Semi furnished", "Fully furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["By search text","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        return view('includes/searchResults')->with('search',"")
                                            ->with('listedFor',"RENT")
                                            ->with('city',"GURUGRAM")
                                            ->with('props',$props)
                                            ->with('sort',$sort)
                                            ->with('ameneties',$ameneties)
                                            ->with('furnishing',$furnishing)
                                            ->with('cities',$citie)
                                            ->with('localities',$locality)
                                            ->with('projects',$projects)
                                            ->with('configuration',$configuration)
                                            ->with('city','GURUGRAM')
                                            ->with('listedFor','RENT')
                                            ->with('closeTo',$closeTo)
                                            ->with('budget','0_0')
                                            ->with('conf','000000')
                                            ->with('furn','000')
                                            ->with('amenety','0000000000000')
                                            ->with('close','0000000')
                                            ->with('sortBy','1000');
    }

    public function filters(){
        $budget1 = explode("_",$_GET['budget'])[0];
        $budget2 = explode("_",$_GET['budget'])[1];
        $conf1 = (str_split($_GET['configuration'])[0] == "1")?"1BHK":null;
        $conf2 = (str_split($_GET['configuration'])[1] == "1")?"2BHK":null;
        $conf3 = (str_split($_GET['configuration'])[2] == "1")?"3BHK":null;
        $conf4 = (str_split($_GET['configuration'])[3] == "1")?"4BHK":null;
        $conf5 = (str_split($_GET['configuration'])[4] == "1")?"5BHK":null;
        $conf6 = (str_split($_GET['configuration'])[5] == "1")?">5BHK":null;
        $amenety = $_GET['ameneties'];
        $closeto = $_GET['closeto'];
        $f1 = $_GET['furnishing'];
        $city = $_GET['city'];
        $listedFor = $_GET['listedFor'];
        $searchListedFor = ($listedFor == "RENT")? "Rent":"Sell";
        $text = ($_GET['search-text'] != null)?$_GET['search-text']:"";
        $sortby = $_GET['sortBy'];
        $ameneties = ["Air-conditioners","Swimming Pool","Sports Arena","Parks","Gym","Intercom","Lifts","Visitor's parking","Pet friendly","Power backup","Wheelchair friendly","Gated society","24*7 water","Mini theatre"];
        $closeTo = ["Metro station","Main Road","Hospital","School","Bus stand","Railway Station","Market"];
        $furnishing = ["Unfurnished","Semi furnished", "Fully furnished"];
        $configuration = ["1BHK","2BHK","3BHK","4BHK","5BHK",">5BHK"];
        $sort =["By search text","Price: low to high","Price: high to low","Date: Newest first"];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        $allprops = properties::where('city','like',$city)
                        ->where('listedFor','like',$searchListedFor);
                        $props1 = DB::table('properties')
                        ->where('city','=',$city)
                        ->where('listedFor','=',$searchListedFor)
                        ->where('locality','like','%'.$text.'%');
        $props2 = DB::table('properties')
                        ->where('city','=',$city)
                        ->where('listedFor','=',$searchListedFor)
                        ->where('streetName','like','%'.$text.'%');
        $props = $props1->union($props2);
        
        $filteredprops1 = $props->whereBetween('expectedPrice',[($budget1 != 0) ? $budget1 : 0,($budget2 != 0)? $budget2 : 10000000000]);
        $greaterByvalue = array("000"=>[0,111],"001"=>[0,9],"010"=> [9, 99], "011" => [0,99], "100"=> [100, 110],"101"=> [0,110],"110"=>[9,110],"111"=>[0,110]);
        $filteredprops2 = $filteredprops1->whereBetween('furnishing',$greaterByvalue[$f1]);
        if($_GET['configuration'] == "000000"){
            $filteredprops3 = $filteredprops2;
        }else{
            $filteredprops3 = $filteredprops2->whereIn('configuration',[$conf1,$conf2,$conf3,$conf4,$conf5,$conf6]);
        }
        $filteredprops4 = $filteredprops3->where('ameneties','>=',$amenety)->where('closeTo','>=', $closeto)->union($allprops);
        if($sortby == "1000"){
            $orderedprops = $filteredprops4;
        }else if ($sortby == "0100"){
            $orderedprops = $filteredprops4->orderBy('expectedPrice');
        }else if ($sortby == "0010"){
            $orderedprops = $filteredprops4->orderBy('expectedPrice', 'DESC');
        }else{
            $orderedprops = $filteredprops4->orderBy('created_at', 'DESC');
        }

        $lastprops = $orderedprops->paginate(8);
        return view('includes/searchResults')->with('search',$text)
                    ->with('props',$lastprops)
                    ->with('sort',$sort)
                    ->with('ameneties',$ameneties)
                    ->with('furnishing',$furnishing)
                    ->with('configuration',$configuration)
                    ->with('cities',$citie)
                    ->with('localities',$locality)
                    ->with('projects',$projects)
                    ->with('closeTo',$closeTo)
                    ->with('city',$city)
                    ->with('listedFor',$listedFor)
                    ->with('budget',$_GET['budget'])
                    ->with('conf',$_GET['configuration'])
                    ->with('furn',$_GET['furnishing'])
                    ->with('amenety',$_GET['ameneties'])
                    ->with('close',$_GET['closeto'])
                    ->with('sortBy',$_GET['sortBy']);
    }
}
