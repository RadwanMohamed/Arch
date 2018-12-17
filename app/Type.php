<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{


    /**
     * relation between types and buildings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings(){
        return $this->hasMany('App\Building');
    }
}
