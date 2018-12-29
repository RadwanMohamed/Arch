<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =[
        'name', 'price', 'square', 'property', 'desc', 'meta', 'address_id', 'description', 'status','rooms', 'user_id', 'type_id'
    ];

    /**
     * user relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * type relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo('App\Type');
    }

    /**
     * address relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(){
        return $this->belongsTo('App\Address');
    }

    /**
     * image relation
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(){
        return $this->morphMany('App\Image','imageable');
    }

}
