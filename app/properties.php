<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class properties extends Model
{
    //Table name
    protected $table = 'properties';

    //primary key
    protected $primaryKey = "id";

    //timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
