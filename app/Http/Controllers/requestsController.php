<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\requests;
class requestsController extends Controller
{
    //
    public function index()
    {
        return view('includes/contact');
    }
    public function store(Request $request)
    {
        $user = new requests;
        $user->name = $request->input('name');
        $user->contact = $request->input('contact');
        $user->email = $request->input('email');
        $user->request = $request->input('request');
        $user->status = "Received";
        $user->save();

        return back()->with('request','sent_successfully');
    }
}
