<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin/includes/login');
    }

    public function login(Request $request){

        $user_data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::attempt($user_data)){
            if($request->input('email') == 'inforentiers@gmail.com'){
                return view('admin/includes/dashboard')->with('success','logged_in');
            }else{
                return view('admin/includes/login')->with('error','wrong_details');
            }
        }else{
            return redirect('admin/includes/login')->with('error','wrong_details');
        }
    }
}
