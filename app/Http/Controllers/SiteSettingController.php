<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Image;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SiteSettingController extends ImageController
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

    public function slider()
    {
        $siteSettings = SiteSetting::where('type','=',1)->get();
        return view("admin.SiteSettings.editslider", compact('siteSettings'));
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

    /**
     * update slider image
     * @param Request $request
     */
    public function updateSlider(SliderRequest $request)
    {
        $slider = Image::where('imageable_type','=','App\SiteSettings')->get();

        if ($slider->count()> 0)
        {
            $this->delete($slider[0]->image_url);
            $filename = $this->uploadFile($request->image);
            $this->updateUrl($slider[0],$filename);
        }
        else
        {
            $filename = $this->uploadFile($request->image);
            $this->addUrl(1,'App\SiteSettings',$filename);
        }

        return redirect("/");

    }

    /**
     * assign  the original image slider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sliderRestore()
    {
        $slider = Image::where('imageable_type','=','App\SiteSettings')->get();
        if ($slider->count() ==0)
            return redirect("/");
        $this->delete($slider[0]->image_url);
        $this->removeUrl($slider[0]);
        return redirect("/");
    }

}
