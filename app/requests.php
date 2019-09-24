<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    //Table name
    protected $table = 'requests';

    //primary key
    protected $primaryKey = "id";

    //timestamps
    public $timestamps = true;

}
