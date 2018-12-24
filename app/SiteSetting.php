<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'slug', 'name', 'value', 'type'
    ];

    public function images(){
        return $this->morphMany('App\Image','imageable');
    }
}
