<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected function search($request,$query)
    {

        foreach (array_except($request->all(),['_token','page']) as $key => $value)
        {
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
    }

    protected function priceSearch($price,$query)
    {

        if ($price != null )
            $query->whereBetween('price',[$price-200,$price]);

    }

    protected function roomsSearch($rooms,$query)
    {

        if ($rooms != null )
            $query->where('rooms','=',$rooms);


    }

}
