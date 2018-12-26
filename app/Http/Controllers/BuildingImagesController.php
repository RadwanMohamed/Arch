<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\ImageRequest;
use App\Image;
use Illuminate\Http\Request;

class BuildingImagesController extends ImageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Building $building,Request $request)
    {
        if($request->ajax())
            return response(['building'=>$building,'images'=>$building->images],200);

        return view("admin.buildings.images.index",compact('building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Building $building)
    {
        return view("admin.buildings.images.create",compact("building"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Building $building,ImageRequest $request)
    {
        $this->uploadMultiple($request->images);
        $this->addAllUrl($building->id, 'App\Building');
        return redirect("admin-panel/buildings/".$building->id."/images ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building,Image $image)
    {
        return view("admin.buildings.images.edit",compact("building","image"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request,$id,Image $image)
    {
        $this->delete($image->image_url);
        $filename = $this->uploadFile($request->images);
        $this->updateUrl($image,$filename);
        return redirect("admin-panel/buildings/".$id."/images ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id,Image $image)
    {
        $this->delete($image->image_url);
        $image->delete();
        return response(['msg' => ' تم حذف الصورة بنجاح ', 'status' => 'success']);
    }
}
