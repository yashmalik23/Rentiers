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
Route::get('allprojects', 'propertiesController@all')->name('allprojects');
Route::get('login', 'loginController@index')->name('login');


Route::post('register', 'loginController@store')->name('register');
Route::post('login','loginController@checklogin');
Route::post('reset','loginController@reset');
Route::post('requests','requestsController@store')->name('requests');


Route::post('listprops', 'propertiesController@store');
Route::post('editprops', 'propertiesController@update')->name('editprops');
Route::post('deleteprops', 'propertiesController@delete')->name('deleteprops');
Route::post('addimagetoprop' , 'propertiesController@addimage')->name('addimagetoprop');
Route::post('changestatus' , 'userAccountController@changestatus')->name('changestatus');


Route::get('logout','loginController@logout')->name('logout');
Route::get('useraccount','userAccountController@index')->name('useraccount');
Route::get('useraccount/{id}','userAccountController@show')->name('propview');
Route::get('useraccountedit/{id}','userAccountController@edit')->name('propedit');
Route::get('password','userAccountController@password')->name('userpassword');
Route::post('changepassword','userAccountController@changepassword')->name('changepassword');
Route::post('changedetails','userAccountController@changedetails')->name('changedetails');

Route::get('images/{id}','userAccountController@images')->name('editimages');
Route::post('deleteimage','userAccountController@deleteimage')->name('deleteimage');
Route::post('changeorder','userAccountController@changeOrder')->name('changeorder');

Route::get('aboutus', array('as'=>'aboutus',function () {
    return view('includes/about');
}));


Route::get('viewproject/{id}', 'propertiesController@showProject')->name('viewproject');

Route::get('search', 'searchController@search')->name('searchresults');
Route::get('searchresult', 'searchController@normal')->name('normalsearch');
Route::get('searchfilter', 'searchController@filters')->name('gosearch');


//User search and view
Route::get('property/{id}','searchController@show')->name('userpropview');
Route::post('interests','interestController@store')->name('addinterest');

//Admin panel
Route::get('traceadmin', 'adminloginController@index')->name('adminlogin');
Route::post('adminlogin', 'adminloginController@login')->name('tryadminlogin');

Route::get('members', 'adminController@members')->name('members');
Route::post('memberdelete','adminController@memberdelete')->name('memberdelete');
Route::get('adminuseraccount/{id}','userAccountController@showaccount')->name('adminuseraccount');

Route::get('sellers', 'adminController@sellers')->name('sellers');
Route::post('sellerdelete','adminController@sellerdelete')->name('sellerdelete');

Route::get('interests', 'interestController@show')->name('interests');
Route::post('interestdelete','interestcontroller@delete')->name('interestdelete');

Route::get('uassets', 'adminController@uassets')->name('uassets');
Route::get('adminview/{id}','adminController@show')->name('adminview');
Route::get('adminedit/{id}','adminController@edit')->name('adminedit');
Route::post('changeverification', 'adminController@changever')->name('changeVer');
Route::post('uaddimagetoprop' , 'adminController@uaddimage')->name('uaddimagetoprop');

Route::get('vassets', 'adminController@vassets')->name('vassets');
Route::post('vaddimagetoprop' , 'adminController@vaddimage')->name('vaddimagetoprop');


Route::get('requests', 'adminController@requests')->name('requests');
Route::post('requestdelete','adminController@requestdelete')->name('requestdelete');
Route::post('requeststatus','adminController@requeststatus')->name('requeststatus');

Route::get('dashboard', 'adminController@dashboard')->name('dashboard');
Route::get('settings', array('as'=>'password',function () {
    return view('admin/includes/password');
}));
Route::post('adminchangepassword','adminController@changepassword')->name('adminchangepassword');
Route::get('adminlogout','adminloginController@logout')->name('adminlogout');


//Admin search routes
Route::get('/members/{text}','adminController@membersearch')->name('membersearch');
Route::get('/sellers/{text}','adminController@sellersearch')->name('sellersearch');
Route::get('/uassets/{text}','adminController@upropsearch')->name('upropsearch');
Route::get('/vassets/{text}','adminController@vpropsearch')->name('vpropsearch');
Route::get('/requests/{text}','adminController@requestsearch')->name('requestsearch');
Route::get('/interests/{text}','interestController@search')->name('interestsearch');