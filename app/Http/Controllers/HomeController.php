<?php

namespace App\Http\Controllers;
use DB;
use App\staticvalues;
use App\properties;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stat = staticvalues::find(1);
        $prop1 = properties::find(explode(",",$stat->recentproperties)[0]);
        $prop2 = properties::find(explode(",",$stat->recentproperties)[1]);
        $prop3 = properties::find(explode(",",$stat->recentproperties)[2]);
        $prop4 = properties::find(explode(",",$stat->recentproperties)[3]);
        $prop5 = properties::find(explode(",",$stat->recentproperties)[4]);
        $prop = [$prop1,$prop2,$prop3, $prop4, $prop5];
        $citie = explode(",",DB::table('suggestions')->find(1)->cities);
        $locality = DB::table('suggestions')->find(1)->localities;
        $projects = DB::table('suggestions')->find(1)->projectNames;
        return view('includes/home')
                ->with('stats',$stat)
                ->with('cities',$citie)
                ->with('localities',$locality)
                ->with('projects',$projects)
                ->with('props',$prop)
                ->with('prop2',$prop2)
                ->with('prop3',$prop3)
                ->with('prop4',$prop4)
                ->with('prop5',$prop5);
    }
}
