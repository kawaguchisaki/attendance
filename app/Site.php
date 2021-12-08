<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'site_name' => 'required',
        );
}
