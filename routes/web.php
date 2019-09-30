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


//Normal website
Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index');
Route::get('contactus', 'requestsController@index')->name('contactus');
Route::get('listproperties', 'propertiesController@index')->name('listproperties');
Route::get('login', 'loginController@index')->name('login');


Route::post('register', 'loginController@store')->name('register');
Route::post('login','loginController@checklogin');
Route::post('requests','requestsController@store')->name('requests');


Route::post('listprops', 'propertiesController@store');
Route::post('editprops', 'propertiesController@update')->name('editprops');
Route::post('deleteprops', 'propertiesController@delete')->name('deleteprops');
Route::post('addimagetoprop' , 'propertiesController@addimage')->name('addimagetoprop');


Route::get('logout','loginController@logout')->name('logout');
Route::get('useraccount','userAccountController@index')->name('useraccount');
Route::get('useraccount/{id}','userAccountController@show')->name('propview');
Route::get('useraccountedit/{id}','userAccountController@edit')->name('propedit');

Route::get('aboutus', array('as'=>'aboutus',function () {
    return view('includes/about');
}));

Route::get('search', array('as'=>'search',function () {
    return view('includes/searchResults');
}));


//Admin panel
Route::get('traceadmin', 'adminController@index')->name('adminlogin');
Route::post('adminlogin', 'adminController@login')->name('tryadminlogin');

Route::get('members', 'adminController@members')->name('members');
Route::post('memberdelete','adminController@memberdelete')->name('memberdelete');

Route::get('sellers', 'adminController@sellers')->name('sellers');
Route::post('sellerdelete','adminController@sellerdelete')->name('sellerdelete');

Route::get('uassets', 'adminController@uassets')->name('uassets');
Route::get('adminview/{id}','adminController@show')->name('adminview');
Route::get('adminedit/{id}','adminController@edit')->name('adminedit');
Route::post('changeverification', 'adminController@changever')->name('changeVer');
Route::post('uaddimagetoprop' , 'adminController@uaddimage')->name('uaddimagetoprop');

Route::get('vassets', 'adminController@vassets')->name('vassets');
Route::post('vaddimagetoprop' , 'adminController@vaddimage')->name('vaddimagetoprop');


Route::get('requests', 'adminController@requests')->name('requests');
Route::get('dashboard', 'adminController@dashboard')->name('dashboard');


//Admin search routes
Route::get('/members/{text}','adminController@membersearch')->name('membersearch');
Route::get('/sellers/{text}','adminController@sellersearch')->name('sellersearch');
Route::get('/uassets/{text}','adminController@upropsearch')->name('upropsearch');
Route::get('/vassets/{text}','adminController@vpropsearch')->name('vpropsearch');