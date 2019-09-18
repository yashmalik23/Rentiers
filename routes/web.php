<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', array('as'=>'home',function () {
    return view('includes/home');
}));
Route::get('aboutus', array('as'=>'aboutus',function () {
    return view('includes/about');
}));
Route::get('contactus', array('as'=>'contactus',function () {
    return view('includes/contact');
}));
Route::get('listproperties', array('as'=>'listproperties',function () {
    return view('includes/list');
}));
Route::get('login', array('as'=>'login',function () {
    return view('includes/login');
}));
Route::get('search', array('as'=>'search',function () {
    return view('includes/searchResults');
}));