<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteSettings = SiteSetting::all();
        return view("admin.SiteSettings.index", compact('siteSettings'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\SiteSetting $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach (array_except(Input::all(), ['_token', '_method']) as $key => $value) {
            SiteSetting::where('name', $key)->update([
                'name' => $key,
                'value' => $value
            ]);
        }
        return response(['msg' => ' تم تغيير الاعدادات بنجاح ', 'status' => 'success']);
    }

}
