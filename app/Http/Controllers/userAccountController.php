<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userAccountController extends Controller
{
    public function index()
    {
        return view('includes/useraccount');
    }
}
