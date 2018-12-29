<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_url','imageable_id','imageable_type'];

    /**
     * image url accessor
     * @param $value
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        return 'images/'.$value;
    }

    /**
     * image relation between diffrerent tables
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(){
        return $this->morphTo();
    }
}
