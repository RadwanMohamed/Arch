<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =[
        'name', 'price', 'square', 'property', 'desc', 'meta', 'address', 'description', 'status', 'user_id', 'type_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

}
