<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\BuildingRequest;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
//        foreach ($buildings as $b){
//            dd($b->address);
//        }
        return view('admin.buildings.index',compact('buildings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.buildings.create',compact('types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {
        Building::create([
            'name'          => $request->name,
            'price'         => $request->price,
            'square'        => $request->square,
            'property'      => $request->property,
            'desc'          => $request->desc,
            'meta'          => $request->meta,
            'address_id'       => $request->address_id,
            'rooms'       => $request->rooms,
            'description'   => $request->description,
            'status'        => $request->status,
            'user_id'       => Auth::id(),
            'type_id'       => $request->type_id
        ]);
        return redirect('/admin-panel/buildings')->with('flash',' تمت اضافة عقار جديد ');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $types = Type::all();
        return view('admin.buildings.edit',compact('building','types'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingRequest $request, Building $building)
    {
        $building->name        = $request->name;
        $building->price       = $request->price;
        $building->square      = $request->square;
        $building->property    = $request->property;
        $building->desc        = $request->desc;
        $building->meta        = $request->meta;
        $building->address     = $request->address;
        $building->description = $request->description;
        $building->status      = $request->status;
        $building->user_id     = Auth::id();
        $building->type_id     = $request->type_id;
        if (!$building->isDirty())
            return redirect()->back()->with('flash', '  يجب تعديل بعض البيانات قبل التحديث  ');
        $building->save();
        return redirect('/admin-panel/buildings')->with('flash',' تمت تعديل بيانات العقار ');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return redirect('/admin-panel/buildings');
    }


}
