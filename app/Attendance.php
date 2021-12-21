<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'date' => 'required',
        'user_id' => 'required',
        'site_id' => 'required',
    );
    
    public function users(){
        return $this->belongsTo('App\User','user_id'); //attendancesテーブルはusersテーブルと１：多
    }
    
    public function site(){
        return $this->belongsTo('App\Site','site_id'); //ttendancesテーブルはsitesテーブルと１：多
    }
}
