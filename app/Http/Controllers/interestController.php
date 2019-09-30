<?php

namespace App\Http\Controllers;
use App\interests;
use Illuminate\Http\Request;

class interestController extends Controller
{
    public function store(Request $request){
        $int = new interests;
        $int->name = $request->input('name');
        $int->contact = $request->input('contact');
        $int->prop_id = $request->input('propid');
        $int->save();
        return back()->with('success',"Interest shown successfully");
    }
}
