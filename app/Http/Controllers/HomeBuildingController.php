<?php

namespace App\Http\Controllers;

use App\Address;
use App\Building;
use App\Http\Requests\AdvancedSearchRequest;
use App\Http\Requests\BuildingRequest;
use App\Type;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
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
            'user_id' => 1,
            'type_id' => $request->type_id
        ]);
        $this->uploadMultiple($request->images);
        $this->addAllUrl($building->id, 'App\Building');
        return redirect('/');
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

// join
/**
 ->join('images',function($join){
$join->on('buildings.id','=','images.imageable_id')
->where('images.imageable_type','=','App\Building');
})

 */
