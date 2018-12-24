<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_url','imageable_id','imageable_type'];

    public function getImageUrlAttribute($value)
    {
        return 'images/'.$value;
    }

    public function imageable(){
        return $this->morphTo();
    }
}
