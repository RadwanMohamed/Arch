<?php

namespace App\Http\Controllers;

use App\Address;
use App\Building;
use App\Http\Requests\AdvancedSearchRequest;
use App\Http\Requests\BuildingRequest;
use App\Http\Requests\ImageRequest;
use App\Image;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\View;

class HomeBuildingController extends SearchController
{




    /**
     * display create form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $types = Type::all();
        return view('website.buildings.add',compact('types'));
    }

    /**
     * store building
     * @param BuildingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BuildingRequest $request)
    {
        $building = Building::create([
            'name' => $request->name,
            'price' => $request->price,
            'square' => $request->square,
            'property' => $request->property,
            'desc' => mb_substr($request->description,0,160),
            'meta' => $request->meta,
            'address_id' => $request->address_id,
            'rooms' => $request->rooms,
            'description' => $request->description,
            'status' => 0,
            'user_id' => (Auth::check() == true)? Auth::id() : 1 ,
            'type_id' => $request->type_id
        ]);
        $this->uploadMultiple($request->images);
        $this->addAllUrl($building->id, 'App\Building');
        return redirect('/');
    }

    public function edit(Building $building)
    {
        if ($building->status != 0 || $building->user_id != Auth::id())
            return redirect()->back();
        $types =Type::all();

        return view('website.buildings.edit',compact('building','types'));
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
        if ($building->status != 0 || $building->user_id != Auth::id())
            return redirect()->back();

        $building->name = $request->name;
        $building->price = $request->price;
        $building->square = $request->square;
        $building->property = $request->property;
        $building->desc = mb_substr($request->description,0,160);
        $building->meta = $request->meta;
        $building->address_id = $request->address_id;
        $building->description = $request->description;
        $building->user_id = Auth::id();
        $building->type_id = $request->type_id;
        if (!$building->isDirty())
            return redirect()->back()->with('flash', '  يجب تعديل بعض البيانات قبل التحديث  ');
        $building->save();
        return redirect('/buildings/'.$building->user_id.'/unactivated')->with('flash', ' تمت تعديل بيانات العقار ');
    }

    /**
     * display images to edit it
     * @param Building $building
     * @return \Illuminate\Contracts\View\View
     */
    public function viewImages(Building $building,Request $request)
    {
        if($request->ajax())
            return response(['building'=>$building,'images'=>$building->images],200);
        return View::make('website.buildings.editimages',compact('building'));
    }


    /**
     * update image by id
     * @param ImageRequest $request
     * @param Building $building
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateImages(ImageRequest $request,Building $building,Image $image)
    {
        if ($building->status != 0 || $building->user_id != Auth::id())
            return redirect()->back();

        $this->delete($image->image_url);
        $filename = $this->uploadFile($request->images);
        $this->updateUrl($image,$filename);
        return redirect("".$building->id."/images");


    }

    /**
     * display all unactivated buildings
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unActivated($id)
    {
        $buildings = Building::where([['status','=',0],['user_id','=',$id]])->paginate(9);
        return view('website.buildings.buildings', compact('buildings'));

    }

    /**
     * display all avialabe buildings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allBuildings(AdvancedSearchRequest $request)
    {
        $query = DB::table('buildings')->select('*')->where('status', 1);
        $this->priceSearch($request->query('price'), $query);
        $this->roomsSearch($request->query('rooms'), $query);
        $buildings = $query->paginate(9);
        return view('website.buildings.buildings', compact('buildings'));
    }


    /**
     * display all [rent | Ownership ] avialabe buildings
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function property(AdvancedSearchRequest $request, $type)
    {

        if (!in_array($type, ["0", "1"]))
            return redirect()->back();

        $query = DB::table('buildings')->select('*')
            ->where([
                ['status', '=', '1'],
                ['property', '=', "$type"]]);

        $this->priceSearch($request->query('price'), $query);
        $this->roomsSearch($request->query('rooms'), $query);
        $buildings = $query->paginate(9);
        return view('website.buildings.buildings', compact('buildings'));
    }

    /***
     *display all avialble building according to its type ('flat'|'villa')
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function type(AdvancedSearchRequest $request, $id)
    {
        $price = $request->query('price');
        $query = DB::table('buildings')->select('*')
            ->where([
                ['status', '=', '1'],
                ['type_id', '=', "$id"]]);

        $this->priceSearch($price, $query);
        $this->roomsSearch($request->query('rooms'), $query);
        $buildings = $query->paginate(9);
        return view('website.buildings.buildings', compact('buildings'));
    }


    /**
     * return all buildings (owned by specific user) with specefic price or rooms
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function userBuildings(AdvancedSearchRequest $request,User $user)
    {
        $query = DB::table('buildings')->select('*')
            ->where([
                ['status', '=', '1'],
                ['user_id', '=', "$user->id"]]);
        $this->priceSearch($request->query('price'), $query);
        $this->roomsSearch($request->query('rooms'), $query);
        $buildings = $query->paginate(9);

//        $buildings = $user->buildings()->where('status',1)->paginate(9);

        return view('website.buildings.buildings', compact('buildings'));
    }







    /**
     * @param Building $building
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Building $building)
    {
       $sametype      = $building->type->buildings()->where('status',1)->inRandomOrder()->take(4)->get();
       $sameBuildings = $building->user->buildings()->where('status',1)->inRandomOrder()->take(4)->get();
        return view('website.buildings.show', compact('building','sameBuildings','sametype'));
    }



    /**
     * display buildings accordin to some search param
     * @param AdvancedSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advancedSearch(AdvancedSearchRequest $request)
    {
        $query = DB::table('buildings')->select('*')
            ->where('status', '=', 1);

        $this->search($request, $query);

        $buildings = $query->paginate(9);
        return view('website.buildings.buildings', compact('buildings'));

    }


}

