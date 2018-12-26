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
    return $price >= 1000000 ? ' مليون جنيه '  : ($price/1000). ' الف جنيه ' ;
}

function getSlider()
{
        $slider = hasSlider();
        if ( $slider == false )
            return "../website/images/banner.jpg";
        else
            return $slider[0]->image_url;
}

function hasSlider()
{
    $slider = \App\Image::where('imageable_type','=','App\SiteSettings')->get();
    return ($slider->count() >0)? $slider : false;
}


function images($id)
{
   $image =  \App\Image::where("imageable_type",'=','App\Building')->where("imageable_id","=",$id)->take(1)->get();
   foreach ($image as $img)
   {
       return $img->image_url;
   }
}

function latestBuildings()
{
    return \App\Building::where('status','=',1)->orderBy("created_at","DESC")->take(12)->get();

}

function subject()
{
    return [
      "suggestion" => 'اقتراح',
        'question' => 'استفسار',
        'problem'  => 'مشكلة',
    ];
}


function unReadMessages(){
    return App\Contact::where("view",0)->get();
}
function notification(){
    return App\Building::where("status",0)->get();
}
