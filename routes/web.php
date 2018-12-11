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


/**
 * User Routes
 */


/**
 * Admin Routes
 */
Route::group(['middleware'=>['admin','web']],function (){

    Route::resource('/adminpanel',"AdminController")->only('index');



    Route::get('/admin-panel/users/data',"UserController@usersTableData");
    Route::resource('/admin-panel/users',"UserController")->except('show');

    Route::get('/admin-panel/admin/{user}/edit',"AdminController@editPassword")->middleware('userauth');
    Route::put('/admin-panel/admin/{user}',"AdminController@updatePassword");

    Route::get('admin-panel/site/settings','SiteSettingController@index');
    Route::put('admin-panel/site/settings','SiteSettingController@update');


    Route::resource('/admin-panel/buildings',"BuildingController")->except('show');


});






Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
