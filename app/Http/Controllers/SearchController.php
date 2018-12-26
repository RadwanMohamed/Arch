<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends ImageController
{
    private  $price = [];
    /**
     * generate query to search using specefic key in database
     * @param $request
     * @param $query
     */

    /**
     * $min =  " " & max = " "
     * $min = "gg" & max = "  "
     * $min = " " & max = "jff"
     * $min = "gg"  & max = "ffg"
     */
    protected function search($request,$query)
    {


        foreach (array_except($request->all(),['_token','page']) as $key => $value)
        {
            if($key == 'min' || $key == 'max')
            {
                $this->price[$key] = ($value== '') ? 0 : (int)$value  ;
                continue;
            }
            if($request->$key == '')
                continue;
            if( $key != 'name' && $key != 'price' )
            {
                $query->where($key,$value);
            }
            elseif ($key== 'price')
            {
                $this->priceSearch($value,$query);
            }
            elseif ($key == 'name' )
            {
                $query->where(function ($q) use ($key,$value){
                    $q->where($key,'like','%'.$value.'%')->orWhere('description','like','%'.$value.'%');
                });
            }

        }
        $this->priceRange($query);

    }

    /**
     * search for buildings in range of prices tha user can enter
     * @param $query
     */
    private function priceRange($query)
    {
        if(isset($this->price['max']))
            ($this->price['max'] == 0)? $query->where('price','>',$this->price['min']) : $query->whereBetween('price', [$this->price['min'], $this->price['max']]);

    }

    /**
     * searches for item using range of prices
     * @param $price
     * @param $query
     */
    protected function priceSearch($price,$query)
    {

        if ($price != null )
            $query->whereBetween('price',[$price-200000,$price]);

    }

    /**search for item by the number of its rooms
     * @param $rooms
     * @param $query
     */
    protected function roomsSearch($rooms,$query)
    {

        if ($rooms != null )
            $query->where('rooms','=',$rooms);


    }


}
