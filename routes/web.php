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
    Route::get('admin-panel/site/settings/slider','SiteSettingController@slider');
    Route::post('admin-panel/site/settings/slider','SiteSettingController@updateSlider');
    Route::post('admin-panel/site/settings/slider/restore','SiteSettingController@sliderRestore');


    Route::get('/admin-panel/buildings/mybuildings',"BuildingController@myBuildings");
    Route::resource('/admin-panel/buildings',"BuildingController")->except('show');
    Route::resource('/admin-panel/buildings.images',"BuildingImagesController")->except('show');

    Route::get('/admin-panel/contacts/messages','ContactController@allMessages');
    Route::get('/admin-panel/contacts','ContactController@all');
    Route::get('/admin-panel/contacts/{contact}/show','ContactController@show');
    Route::delete('/admin-panel/contacts/{contact}','ContactController@destroy');
    Route::delete('/admin-panel/contacts/read/delete','ContactController@deleteReadMessages');
    Route::delete('/admin-panel/contacts/all/delete','ContactController@deleteAll');
    Route::post('/admin-panel/contacts/{contact}/notread','ContactController@notRead');



});


/**
 * User Routes
 */



Route::group(['middleware'=>['status:building']],function (){
    Route::get("/buildings/{building}",'HomeBuildingController@show');

});

Route::get("/buildings/",'HomeBuildingController@allBuildings');
Route::get("/user/{user}/buildings/",'HomeBuildingController@userBuildings');
Route::get("/buildings/possession/{type}/",'HomeBuildingController@property');
Route::get("/buildings/type/{type}/",'HomeBuildingController@type');
Route::get("/buildings/advanced/search/",'HomeBuildingController@advancedSearch')->name('search');
Route::resource('/contactus','ContactController')->only(['index','store']);
Route::get('/building/add','HomeBuildingController@add');
Route::post('/building/store','HomeBuildingController@store');


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get("/countries",'CountriesController@index');
