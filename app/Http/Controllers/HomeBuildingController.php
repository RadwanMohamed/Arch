<?php

namespace App\Http\Controllers;

use App\Building;
use App\Type;
use Illuminate\Http\Request;

class HomeBuildingController extends Controller
{
    /**
     * display all avialabe buildings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allBuildings()
    {
        // 40 / 45 /48
        $buildings = Building::where('status',1)->paginate(9);
        return view('website.buildings.all',compact('buildings'));
    }
    /**
     * @param $type
     * display all [rent | Ownership ] avialabe buildings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function property($type)
    {
        if(!in_array($type,["0","1"]) )
            return redirect()->back();

        $buildings = Building::where([
                                         ['status', '=', '1'],
                                         ['property', '=', "$type"]
                                     ])->paginate(9);

        return view('website.buildings.all',compact('buildings'));
    }

    /***
     * @param $id
     * display all avialble building according to its type ('flat'|'villa')
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function type($id)
    {
        $buildings = Building::where([
                                        ['status', '=', '1'],
                                        ['type_id', '=', "$id"]
                                    ])->paginate(9);
        return view('website.buildings.all',compact('buildings'));
    }
}
