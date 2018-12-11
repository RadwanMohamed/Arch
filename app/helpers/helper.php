<?php

function siteSetting($key=""){
    return App\SiteSetting::where('name',$key)->get()[0]->value;

}
