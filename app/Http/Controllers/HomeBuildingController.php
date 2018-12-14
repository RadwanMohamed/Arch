<?php

namespace App\Http\Controllers;

use App\Building;
use App\Http\Requests\AdvancedSearchRequest;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     *display all avialble building according to its type ('flat'|'villa')
     * @param $id
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


    /**
     * display buildings accordin to some search param
     * @param AdvancedSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advancedSearch(AdvancedSearchRequest $request)
    {
        $query = DB::table('buildings')->select('*')
                ->where('status','=',1);

        foreach (array_except($request->all(),['_token','page']) as $key => $value)
        {
            if($request->$key != '' && $key != 'name')
            {
               $query->where($key,$value);
            }
            elseif ($key == 'name')
            {
                $query->where(function ($q) use ($key,$value){
                    $q->where($key,'like','%'.$value.'%')->orWhere('description','like','%'.$value.'%');
                });
            }

        }

        $buildings = $query->paginate(9);
        return view('website.buildings.all',compact('buildings'));

    }




}
