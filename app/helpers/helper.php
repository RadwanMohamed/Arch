<?php

function siteSetting($key="")
{
    return App\SiteSetting::where('name',$key)->get()[0]->value;

}

function buildingTypes()
{
    return App\Type::all();
}

function typeCount($type='status',$value='1')
{
  return App\Building::where([
                             ['status','=','1'],
                             ["$type",'=',"$value"],
                          ])->count();
}


function propertyName($type)
{
    return $type == 0 ? ' ايجار '  :  ' تمليك ' ;
}

function buildingPrice($price)
{
    return $price >= 1000 ? ' مليون جنيه '  : $price. ' الف جنيه ' ;
}

