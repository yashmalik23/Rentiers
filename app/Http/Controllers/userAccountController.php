<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\users;
use App\properties;
use Illuminate\Http\Request;

class userAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->id != null){
            $id = $user->id;
            $props = DB::select('SELECT * from properties where user_id='.$id);
            return view('includes/useraccount')->with('props', $props);
        }else{
            return view('includes/login');
        }
    }

    public function show($id){
        $user = Auth::user();
        if($user->id != null){
            $props = DB::select('SELECT * from properties where id='.$id);
            return view('includes/view')->with('props', $props);
        }else{
            return view('includes/login');
        }
    }
}
