<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class interests extends Model
{
    //Table name
    protected $table = 'interests';

    //primary key
    protected $primaryKey = "id";

    //timestamps
    public $timestamps = true;
}
