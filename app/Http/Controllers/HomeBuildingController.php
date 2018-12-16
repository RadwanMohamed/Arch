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
     * 1- show building details
     * 2- its map
     * 3- buildings alike
     * 4- add different types to  home navbar menu
     * 5- home page + search
     * 6- file upload for website and building with default image
     * 7- main slider
     * 8- arabic fonts
     * 9- amazing product view css (product quick view) عرضاخر المشاريع ajax (l65)
     *10- image intervension (l67)
     *11- share page (add this )
     *12- contact us
     *13- edit admin panel notification
     *14- user adds buildings
     *15- activate building
     *16- user control his own data and his buildings
     */

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


    public function show(Building $building)
    {
        return view('website.buildings.show', compact('building'));
    }

}
