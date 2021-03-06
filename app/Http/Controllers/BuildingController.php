<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\BuildingRequest;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BuildingController extends ImageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
        return view('admin.buildings.index', compact('buildings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.buildings.create', compact('types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {
        $building = Building::create([
            'name' => $request->name,
            'price' => $request->price,
            'square' => $request->square,
            'property' => $request->property,
            'desc' => $request->desc,
            'meta' => $request->meta,
            'address_id' => $request->address_id,
            'rooms' => $request->rooms,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::id(),
            'type_id' => $request->type_id
        ]);
        $this->uploadMultiple($request->images);
        $this->addAllUrl($building->id, 'App\Building');
        return redirect('/admin-panel/buildings')->with('flash', ' تمت اضافة عقار جديد ');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $types = Type::all();
        return view('admin.buildings.edit', compact('building', 'types'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Building $building
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingRequest $request, Building $building)
    {
        $building->name = $request->name;
        $building->price = $request->price;
        $building->square = $request->square;
        $building->property = $request->property;
        $building->desc = $request->desc;
        $building->meta = $request->meta;
        $building->address_id = $request->address_id;
        $building->description = $request->description;
        $building->status = $request->status;
        $building->user_id = Auth::id();
        $building->type_id = $request->type_id;
        if (!$building->isDirty())
            return redirect()->back()->with('flash', '  يجب تعديل بعض البيانات قبل التحديث  ');
        $building->save();
        return redirect('/admin-panel/buildings')->with('flash', ' تمت تعديل بيانات العقار ');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $this->deleteAll($building->images);
        $this->removeAllUrl($building->images);
        $building->delete();
        return redirect('/admin-panel/buildings');
    }

    /**
     * display all builinds for current user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myBuildings()
    {
        $buildings = Building::where('user_id',1)->get();
        return view('admin.buildings.mybuildings', compact('buildings'));
    }

    /**
     * activate specific building
     * @param Building $building
     */
    public function activate(Building $building)
    {
        $building->update(['status'=>1]);
        return redirect('/admin-panel/buildings');

    }

    /**
     * unactivate the building
     * @param Building $building
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unactivate(Building $building)
    {
        $building->update(['status'=>0]);
        return redirect('/admin-panel/buildings');

    }

    /**
     * activate all buildings
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activateAll()
    {
        $buildings = Building::where('status','=',0)->get();
        foreach ($buildings as $building)
        {
            $this->activate($building);
        }
        return redirect('/admin-panel/buildings');

    }

}
