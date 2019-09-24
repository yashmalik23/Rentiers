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

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index');
Route::get('contactus', 'requestsController@index')->name('contactus');
Route::get('listproperties', 'propertiesController@index')->name('listproperties');
Route::get('login', 'loginController@index')->name('login');


Route::post('register', 'loginController@store')->name('register');
Route::post('login','loginController@checklogin');
Route::post('requests','requestsController@store');
Route::post('listprops', 'propertiesController@store');


Route::get('logout','loginController@logout');
Route::get('useraccount','userAccountController@index')->name('useraccount');

Route::get('aboutus', array('as'=>'aboutus',function () {
    return view('includes/about');
}));

Route::get('search', array('as'=>'search',function () {
    return view('includes/searchResults');
}));

