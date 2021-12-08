<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housemaker extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'housemaker_name' => 'required',
        );
}
