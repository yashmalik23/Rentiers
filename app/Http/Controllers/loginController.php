<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('includes/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = DB::table('users')->where('email','=',$request->input('email'))->get();
        if(count($check)>0){
            return back()->with('error','wrong_details');
        }
        $user = new User;
        $user->name = $request->input('name');
        $user->contact = $request->input('contact');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->remember_token = str_random(10);
        $user->member = $request->input('signupas');
        $user->save();

        $user_data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/');
        }else{
            return back()->with('error','wrong_details');
        }
        
    }
    public function mobile(Request $request)
    {
        $check = DB::table('users')->where('contact','=',$request->input('mobile'))->get();
        if(count($check)>0){
            $user = User::find($check[0]->id) ;
            Auth::login($user);
            return redirect('/');
        }
        $user = new User;
        $user->name = "Anonymous";
        $user->contact = $request->input('mobile');
        $user->email = 'noemail@mobile.com';
        $user->password = Hash::make('none');
        $user->remember_token = str_random(10);
        $user->member = "Member";
        $user->save();

        $check = DB::table('users')->where('contact','=',$request->input('mobile'))->get();
        if(count($check)>0){
            $user = User::find($check[0]->id);
            Auth::login($user);
            return redirect('/');
        }else{
            return back()->with('error','wrong_details');
        }
        
    }

    public function checklogin(Request $request){
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );


        if(Auth::attempt($user_data)){
            return redirect('/');
        }else{
            return back()->with('error','wrong_details');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email, $password)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
