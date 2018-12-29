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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/**
 * Admin Routes
 */
Route::group(['middleware'=>['admin','web']],function (){

    Route::resource('/adminpanel',"AdminController")->only('index');
    Route::get('/adminpanel/stat',"AdminController@stats");
    Route::get('/adminpanel/year',"AdminController@staticsYear");



    Route::get('/admin-panel/users/data',"UserController@usersTableData");
    Route::resource('/admin-panel/users',"UserController")->except('show');
    Route::get('/admin-panel/users/{user}/buildings',"UserController@userBuildings");

    Route::get('/admin-panel/admin/{user}/edit',"AdminController@editPassword")->middleware('userauth');
    Route::put('/admin-panel/admin/{user}',"AdminController@updatePassword");

    Route::get('admin-panel/site/settings','SiteSettingController@index');
    Route::put('admin-panel/site/settings','SiteSettingController@update');
    Route::get('admin-panel/site/settings/slider','SiteSettingController@slider');
    Route::post('admin-panel/site/settings/slider','SiteSettingController@updateSlider');
    Route::post('admin-panel/site/settings/slider/restore','SiteSettingController@sliderRestore');


    Route::get('/admin-panel/buildings/activate',"BuildingController@activateAll");
    Route::get('/admin-panel/buildings/{building}/activate',"BuildingController@activate");
    Route::get('/admin-panel/buildings/{building}/unactivate',"BuildingController@unactivate");
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
Route::get("/buildings/{user}/unactivated",'HomeBuildingController@unActivated');


Route::resource('/contactus','ContactController')->only(['index','store']);


Route::get('/building/add','HomeBuildingController@add');
Route::post('/building/store','HomeBuildingController@store');
Route::get('/buildings/{building}/edit','HomeBuildingController@edit');
Route::put('/buildings/{building}','HomeBuildingController@update');


Route::get('/{building}/images/','HomeBuildingController@viewImages');
Route::put('/{building}/images/{image}','HomeBuildingController@updateImages');

Route::get('/{user}/password/reset',"UserController@resetPasswordView")->middleware('userauth');
Route::post('/{user}/password/reset',"UserController@updatePassword");

Route::get('/{user}/email/reset',"UserController@resetEmailView")->middleware('userauth');
Route::post('/{user}/email/reset',"UserController@updateEmail");

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get("/countries",'CountriesController@index');
