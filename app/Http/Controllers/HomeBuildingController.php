<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\AdvancedSearchRequest;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeBuildingController extends SearchController
{




    /**
     * display all avialabe buildings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allBuildings(AdvancedSearchRequest $request)
    {
        $query =  DB::table('buildings')->select('*')->where('status',1);
        $this->priceSearch( $request->query('price') , $query);
        $this->roomsSearch($request->query('rooms'),$query);
        $buildings = $query->paginate(9);
        return view('website.buildings.all',compact('buildings'));
    }


    /**
     * @param $type
     * display all [rent | Ownership ] avialabe buildings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function property(AdvancedSearchRequest $request,$type)
    {

        if(!in_array($type,["0","1"]) )
            return redirect()->back();

        $query =  DB::table('buildings')->select('*')
                                              ->where([
                                                        ['status', '=', '1'],
                                                        ['property', '=', "$type"]] );

        $this->priceSearch($request->query('price'),$query);
        $this->roomsSearch($request->query('rooms'),$query);
        $buildings = $query->paginate(9);
        return view('website.buildings.all',compact('buildings'));
    }

    /***
     *display all avialble building according to its type ('flat'|'villa')
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function type(AdvancedSearchRequest $request,$id)
    {
        $price = $request->query('price');
        $query = DB::table('buildings')->select('*')
                                            ->where([
                                        ['status', '=', '1'],
                                        ['type_id', '=', "$id"]]);

        $this->priceSearch($price,$query);
        $this->roomsSearch($request->query('rooms'),$query);
        $buildings = $query->paginate(9);
        return view('website.buildings.all',compact('buildings'));
    }


    /**
     * display buildings accordin to some search param
     * @param AdvancedSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advancedSearch(AdvancedSearchRequest $request)
    {
        $query = DB::table('buildings')->select('*')
                ->where('status','=',1);

        $this->search($request,$query);

        $buildings = $query->paginate(9);
        return view('website.buildings.all',compact('buildings'));

    }




}
