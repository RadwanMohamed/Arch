<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =[
        'name', 'price', 'square', 'property', 'desc', 'meta', 'address_id', 'description', 'status','rooms', 'user_id', 'type_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

}
