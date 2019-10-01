<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staticvalues extends Model
{
    //Table name
    protected $table = 'staticvalues';

    //primary key
    protected $primaryKey = "id";

    //timestamps
    public $timestamps = true;
}
