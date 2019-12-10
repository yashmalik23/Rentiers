<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\Request;
use vendor\autoload;


use App\Mail\TestEmail;

class loginController extends Controller
{

    private $key = "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";
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

        $phone = DB::table('users')->where('contact','=',$request->input('code').$request->input('contact'))->get();
        if(count($phone)>0){
            return back()->with('error','wrong_details');
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->contact = $request->input('code').$request->input('contact');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->remember_token = str_random(10);
        $user->member = "Member";
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

    public function checklogin(Request $request){
        $phone = DB::table('users')->where('contact','=',$request->input('code').$request->input('contact'))->get();
        if(count($phone)>0){
            $user_data = array(
                'email' => $phone[0]->email,
                'password' => $request->get('password')
            );
    
            if(Auth::attempt($user_data)){
                return redirect('/');
            }else{
                return back()->with('error','wrong_details');
            }
        }else{
            return back()->with('error','wrong_details');
        }
    }

    public function reset(Request $request){
        $check = DB::table('users')->where('email','=',$request->input('email'))->get();
        if(count($check) ==0){
            return back()->with('error','wrong_details');
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pass = substr(str_shuffle($permitted_chars), 0, 10);
        $user = User::find($check[0]->id);
        $user->password = Hash::make($pass);
        $user->save();
        $data = ['message' => 'Your new password for rentiers.in is '.$pass.'. If you didn\'t request this please contact us on +91 8860050003/4/6' ];
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("rentiersalerts@gmail.com", "Rentiers Gurgaon");
        $email->setSubject("Reset password");
        $email->addTo($user->email, $user->name);
        $email->addContent("text/plain", $data['message']);
        $sendgrid = new \SendGrid($this->key);
        $response = $sendgrid->send($email);

        return redirect(route('login'))->with('new',"Password sent to registered email");
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
